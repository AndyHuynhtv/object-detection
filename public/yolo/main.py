import cv2
import torch
from datetime import datetime
import requests
import torchvision.transforms as T
import schedule
import time
import os

model = torch.hub.load('ultralytics/yolov5', 'yolov5m', pretrained=True)

device = torch.device('cuda') \
    if torch.cuda.is_available() \
    else torch.device('cpu')
model.to(device)

classes = []
with open("dnn_model/classes.txt", "r") as file_object:
    for class_name in file_object.readlines():
        class_name = class_name.strip()
        classes.append(class_name)

cap = cv2.VideoCapture(0)
cap.set(cv2.CAP_PROP_FRAME_WIDTH, 1280)
cap.set(cv2.CAP_PROP_FRAME_HEIGHT, 720)

count_persons = 0
image_path = None
data_sent = False

while True:
    ret, frame = cap.read()
    frame_rgb = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
    results = model(frame_rgb)

    pred_classes = results.pred[0][:, -1].cpu().numpy().astype(int)
    pred_scores = results.pred[0][:, 4].cpu().numpy()
    pred_boxes = results.pred[0][:, :4].cpu().numpy()

    for class_id, score, bbox in zip(pred_classes, pred_scores, pred_boxes):
        if classes[class_id] == "person" and score > 0.7:
            x, y, w, h = bbox
            count_persons += 1
            cv2.putText(frame, classes[class_id], (int(x), int(y)-10), cv2.FONT_HERSHEY_PLAIN, 2, (200, 0, 50), 2)
            cv2.rectangle(frame, (int(x), int(y)), (int(x+w), int(y+h)), (200, 0, 50), 2)

    try:
        # Đường dẫn thư mục để lưu ảnh
        image_directory = "D:\_OBJECT-DETECTION\object-detection\public\image_checking"
        # Lưu ảnh và lấy đường dẫn
        image_filename = f"checking_{datetime.now().strftime('%Y%m%d%H%M%S')}.jpg"
        image_path = image_directory + "/" + image_filename
        cv2.imwrite(image_path, frame)

        print("Count Persons:", count_persons)
        response = requests.post('http://127.0.0.1:5000/data_yolo',json={'count_persons': count_persons, 'image_path': image_path})

        if response.status_code == 200:
            data = response.json()
            print('Phản hồi từ máy chủ:', data)
        else:
            print('Không thể lấy dữ liệu từ API')
    except Exception as e:
        print('Lỗi:', e)

    cv2.putText(frame, f"Number of persons: {count_persons}", (10, 50), cv2.FONT_HERSHEY_PLAIN, 2, (0, 255, 0), 2)
    cv2.imshow("Frame", frame)

    if cv2.waitKey(1) & 0xFF == ord('q'):
        break
    count_persons = 0

cap.release()
cv2.destroyAllWindows()
