from flask import Flask, jsonify, request
from flask_cors import CORS
import requests

app = Flask(__name__)
CORS(app)

count_persons = 0
image_path = ''
start_yolo_detection = 0
send = 0

@app.route('/start_yolo', methods=['post'])
def start_yolo():
    global start_yolo_detection

    data = request.json  # 1

    if 'start_detection' in data:
        start_yolo_detection = data['start_detection']
        if start_yolo_detection == 1:
            return jsonify(start_yolo_detection)
    return jsonify({'message': 'Invalid data'})
        
# gửi dữ liệu về web 
@app.route('/send_data_yolo', methods=['GET'])
def send_data_yolo():
    global start_yolo_detection
    if start_yolo_detection == 1: #chưa gửi 
        data_get = {
            'start_yolo_detection': 1
        }
        start_yolo_detection = 0
    else:
        data_get = {
            'start_yolo_detection': 0
        }
    return jsonify(data_get)

# Nhận dữ liệu từ yolo
@app.route('/data_yolo', methods=['POST'])
def data_yolo():
    global count_persons
    global image_path
    try:
        data = request.json 
        if 'count_persons' in data:
            count_persons = data['count_persons']
            image_path = data['image_path']
            return jsonify({'Message': image_path})
        return jsonify({'Message': 'Invalid data'}), 400
    except Exception as e:
        return jsonify({'Message': 'Error', 'error': str(e)}), 500

# gửi dữ liệu về web
@app.route('/data_web', methods=['GET'])
def data_web():
    data_get = {
        'number': count_persons,
        'image_path': image_path
    }
    return jsonify(data_get)

if __name__ == '__main__':
    app.run(debug=True)