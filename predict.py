import numpy as np
import pickle
import joblib
import json
import pandas as pd
import sys
from sklearn.preprocessing import StandardScaler
from sklearn.model_selection import train_test_split
from sklearn.metrics import accuracy_score, classification_report, confusion_matrix

# Load the dataset
heart = pd.read_csv("heart_cleveland_upload.csv")

# Split the dataset into features and target
x = heart.drop(columns='condition')
y = heart['condition']

# Initialize the scaler and fit it on the dataset
scaler = StandardScaler().fit(x)

# Load the trained model
model_filename = 'heart-disease-prediction-knn-model.pkl'
model = joblib.load(model_filename)

# Collect inputs passed via PHP (received as command-line arguments)
input_values = list(map(float, sys.argv[1:14]))

input_array = np.array(input_values).reshape(1, -1)

# Convert to DataFrame with the same columns as the original dataset
input_df = pd.DataFrame(input_array, columns=x.columns)

# Scale the input using the scaler fitted on the original dataset
scaled_input = scaler.transform(input_df)

# Make a prediction on the input values
prediction = model.predict(scaled_input)

# Split data into training and test sets for evaluation
x_train, x_test, y_train, y_test = train_test_split(x, y, test_size=0.25, random_state=42)

# Scale the test data using the same scaler fitted on the training data
x_test_scaled = scaler.transform(x_test)

# Make predictions on the test set
y_pred = model.predict(x_test_scaled)

# Calculate the accuracy
accuracy = accuracy_score(y_test, y_pred)

# Prepare the classification report and confusion matrix
classification_report_result = classification_report(y_test, y_pred)
confusion_matrix_result = confusion_matrix(y_test, y_pred)

# Construct the output in JSON format
output = {
    "prediction": int(prediction[0]),  # Ensure it's an integer
    "accuracy": accuracy * 100,  # Convert accuracy to percentage
    "classification_report": classification_report_result,
    "confusion_matrix": confusion_matrix_result.tolist()  # Convert matrix to list if necessary
}

# Output only the JSON response
print(json.dumps(output))