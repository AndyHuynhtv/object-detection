from setuptools import setup

setup(
    name="People detection and counting",
    version="1.0",
    description="Detect and count people in a lab",
    install_requires=[
        'opencv-python',
        'torch',
        'torchvision',
        'numpy',
    ],
    packages=['yolov5','dnn_model'],
    dependency_links=[
        'https://github.com/ultralytics/yolov5/tarball/master#egg=yolov5-0.0.0',
    ],
    entry_points={
        'console_scripts': [
            'people_detection=main:main',
        ],
    },
)

