from flask import Flask, jsonify, request
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

count_persons = 0
image_path = ''
start_yolo_detection = 1

@app.route('/start_yolo', methods=['POST'])
def start_yolo():
    global start_yolo_detection

    data = request.json #1

    if 'start_detection' in data:
        start_yolo_detection = data['start_detection']
        if start_yolo_detection:
            return jsonify(start_yolo_detection)

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


@app.route('/data_web', methods=['GET'])
def data_web():
    data_get = {
        'number': count_persons,
        'image_path': image_path
    }
    return jsonify(data_get)

if __name__ == '__main__':
    app.run(debug=True)