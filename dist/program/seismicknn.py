import numpy as np
import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.metrics import accuracy_score
from sklearn.neighbors import KNeighborsClassifier
from datetime import date
import time


today = date.today()
t = time.localtime()

def knn(pga1,pga2,pga3):
    sensor1 = pga1
    sensor2 = pga2
    sensor3 = pga3

    dataset_gempaknn = pd.read_csv('gempaknn.csv', delimiter=',')

    X = np.array(dataset_gempaknn[['sensorsatu','sensordua','sensortiga']])

    y = np.array(dataset_gempaknn['label'])

    X_train, X_test, y_train, y_test = train_test_split(X,y,test_size=0.1)

    clf = KNeighborsClassifier(n_neighbors=5)

    clf.fit(X_train,y_train)

    prediksi = clf.predict(X_test)

    akurasi = accuracy_score(prediksi, y_test)

    akurasie = round(akurasi*100,2)

    input_gempa = clf.predict([[sensor1,sensor2,sensor3]])

    string = str(input_gempa)
    string = string.replace("[","")
    string = int(string.replace("]",""))

    tanggal = today.strftime("%Y/%m/%d")
    waktu = time.strftime("%H:%M:%S", t)

    return akurasi, string, tanggal, waktu
   
