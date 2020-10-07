from fuzzy import *
from seismicknn import *
import threading
import requests
import json
from collections import namedtuple
import mysql.connector
from mysql.connector import Error
from mysql.connector import errorcode
from antares_http import antares

alat = 0

test = 0
while True:
    sigbmkg = ""
    sigbmkg2 = ""
    sigbmkg3 = ""
    
    url = "https://platform.antares.id:8443/~/antares-cse/antares-id/EarthquakeDetector/sensor1/la"
    url2 = "https://platform.antares.id:8443/~/antares-cse/antares-id/EarthquakeDetector/sensor2/la"
    url3 = "https://platform.antares.id:8443/~/antares-cse/antares-id/EarthquakeDetector/sensor3/la"
    
    payload = ""
    payload2 = ""
    payload3 = ""
    
    headers = {
        'X-M2M-Origin': "d2a4e28b0c316687:41fd4960fcee58c8",
        'Content-Type': "application/json;ty=4",
        'Accept': "application/json",
        'cache-control': "no-cache"
    }

    response = requests.request("GET", url, data=payload, headers=headers).json()
    response2 = requests.request("GET", url2, data=payload2, headers=headers).json()
    response3 = requests.request("GET", url3, data=payload3, headers=headers).json()
    
    data = response
    data2 = response2
    data3 = response3
    
    result0 = json.loads(data['m2m:cin']['con'] , object_hook=lambda d: namedtuple('U', d.keys())(*d.values()))
    result1 = json.loads(data2['m2m:cin']['con'] , object_hook=lambda d: namedtuple('Y', d.keys())(*d.values()))
    result2 = json.loads(data3['m2m:cin']['con'] , object_hook=lambda d: namedtuple('Z', d.keys())(*d.values()))


    sensor0 = result0.s
    loc0 = result0.c
    sensor1 = result1.s
    loc1 = result1.c
    sensor2 = result2.s
    loc2 = result2.c

    hasil0 = sensor0.split(';')
    location0 = loc0.split('_')
    hasil1 = sensor1.split(';')
    location1 = loc1.split('_')
    hasil2 = sensor2.split(';')
    location2 = loc2.split('_')

    sensorPGA0 = float(hasil0[0])
    waktu0 = hasil0[1]
    tanggal0 = hasil0[2]

    sensorPGA1 = float(hasil1[0])
    waktu1 = hasil1[1]
    tanggal1 = hasil1[2]
    
    sensorPGA2 = float(hasil2[0])
    waktu2 = hasil2[1]
    tanggal2 = hasil2[2]

    lat0 = location0[0]
    long0 = location0[1]
    lat1 = location1[0]
    long1 = location1[1]
    lat2 = location2[0]
    long2 = location2[1]



    sensor1 = float(sensorPGA0 * 981)
    sensor2 = float(sensorPGA1 * 981)
    sensor3 = float(sensorPGA2 * 981)
    
    if(test == 0):
        hehe0 = waktu0
        hehe1 = waktu1
        hehe2 = waktu2
        test = test+1
    
    if(sensor1 < 2.9):
        sigbmkg = "I"
    elif((sensor1 >= 2.9) and (sensor1 <=88)):
        sigbmkg = "II"
    elif((sensor1 >= 89) and (sensor1 <=167)):
        sigbmkg = "III"
    elif((sensor1 >= 168) and (sensor1 <=564)):
        sigbmkg = "IV"
    else:
        sigbmkg = "V"


    if(sensor2 < 2.9):
        sigbmkg2 = "I"
    elif((sensor2 >= 2.9) and (sensor2 <=88)):
        sigbmkg2 = "II"
    elif((sensor2 >= 89) and (sensor2 <=167)):
        sigbmkg2 = "III"
    elif((sensor2 >= 168) and (sensor2 <=564)):
        sigbmkg2 = "IV"
    else:
        sigbmkg2 = "V"


    if(sensor3 < 2.9):
        sigbmkg3 = "I"
    elif((sensor3 >= 2.9) and (sensor3 <=88)):
        sigbmkg3 = "II"
    elif((sensor3 >= 89) and (sensor3 <=167)):
        sigbmkg3 = "III"
    elif((sensor3 >= 168) and (sensor3 <=564)):
        sigbmkg3 = "IV"
    else:
        sigbmkg3 = "V"
       
    
    print(sensorPGA0, sigbmkg, long0, lat0, tanggal0, waktu0,sensor1)
    print(sensorPGA1, sigbmkg2, long1, lat1, tanggal1, waktu1,sensor2)
    print(sensorPGA2, sigbmkg3, long2, lat2, tanggal2, waktu2,sensor3)
    
    if(hehe0 != waktu0) or (hehe1 != waktu1) or (hehe2 != waktu2):
        pga1 = sensor1
        pga2 = sensor2
        pga3 = sensor3

        hasil, tanggal, waktu = fuzzy(pga1,pga2,pga3)
        #print("Fuzzy: ",hasil, tanggal, waktu)

        akurasi, hasilknn, tanggalknn, waktuknn = knn(pga1,pga2,pga3)
        #print("KNN: ", akurasi,"%",hasilknn,tanggalknn,waktuknn)

        if(alat == 0):
            data = {
                'h': hasil
            }
            
            antares.setAccessKey('d2a4e28b0c316687:41fd4960fcee58c8')
            antares.send(data, 'EarthquakeDetector', 'output')
        else:
            data = {
                'h': hasilknn
            }
            
            antares.setAccessKey('d2a4e28b0c316687:41fd4960fcee58c8')
            antares.send(data, 'EarthquakeDetector', 'output')

        
        connection = mysql.connector.connect(host='localhost',
                                         database='earthquake',
                                         user='root',
                                         password='')
        cursor = connection.cursor()
        
        mySql_insert_query = """INSERT INTO sensor1 (pga1, sigbmkg, longtitude, latitude, tanggal, waktu) VALUES (%s, %s, %s, %s, %s, %s) """
        mySql_insert_query2 = """INSERT INTO sensor2 (pga2, sigbmkg, longtitude, latitude, tanggal, waktu) VALUES (%s, %s, %s, %s, %s, %s) """
        mySql_insert_query3 = """INSERT INTO sensor3 (pga3, sigbmkg, longtitude, latitude, tanggal, waktu) VALUES (%s, %s, %s, %s, %s, %s) """
        mySql_insert_fuzzy = """INSERT INTO fuzzy (hasil, pga1, pga2, pga3, tanggal, waktu) VALUES (%s, %s, %s, %s, %s, %s) """
        mySql_insert_knn = """INSERT INTO knn (hasilk, pga1, pga2, pga3, tanggal, waktu) VALUES (%s, %s, %s, %s, %s, %s) """

        recordTuple = (sensor1, sigbmkg, long0, lat0, tanggal0, waktu0)
        recordTuple2 = (sensor2, sigbmkg2, long1, lat1, tanggal1, waktu1)
        recordTuple3 = (sensor3, sigbmkg3, long2, lat2, tanggal2, waktu2)
        recordFuzzy = (hasil, pga1, pga2, pga3, tanggal, waktu)
        recordKNN = (hasilknn, pga1, pga2, pga3, tanggalknn, waktuknn)

        
        cursor.execute(mySql_insert_query, recordTuple)
        cursor.execute(mySql_insert_query2, recordTuple2)
        cursor.execute(mySql_insert_query3, recordTuple3)
        cursor.execute(mySql_insert_fuzzy, recordFuzzy)
        cursor.execute(mySql_insert_knn, recordKNN)
        
        connection.commit()
        print("Record inserted successfully into Laptop table")
        hehe0 = waktu0
        hehe1 = waktu1
        hehe2 = waktu2

        
