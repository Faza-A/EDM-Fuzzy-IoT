from decimal import Decimal
import sys
from datetime import date
import time

today = date.today()
t = time.localtime()


def fuzzy(pga1, pga2, pga3):
    namaSensor1 = ["putih1", "hijau1", "kuning1", "jingga1", "merah1"]
    namaSensor2 = ["putih2", "hijau2", "kuning2", "jingga2", "merah2"]
    namaSensor3 = ["putih3", "hijau3", "kuning3", "jingga3", "merah3"]

    nilaiSensor1 = [0 for i in range(5)]
    nilaiSensor2 = [0 for i in range(5)]
    nilaiSensor3 = [0 for i in range(5)]
    nilaiKondisi = [0 for i in range(125)]
    status = [0 for i in range(125)]


    #================FUZZIFIKASI SENSOR 1==================

    def putih1(sensor1):
        if(sensor1 >= 2.9):
            hasil = 0
        elif((sensor1 > 2.8) and (sensor1 < 2.9)):
            hasil = Decimal((2.9 - sensor1)/(2.9-2.8))
        else:
            hasil = 1
        return round(hasil,3)

    def hijau1(sensor1):
        
        if((sensor1 <= 2.8) or (sensor1 >= 89)):
            hasil = 0
        elif((sensor1 > 2.8) and (sensor1 < 2.9)):
            hasil = Decimal((sensor1 - 2.8)/(2.9-2.8))
        elif((sensor1 > 88) and (sensor1 < 89)):
            hasil = Decimal((89 - sensor1)/(89-88))
        else:
            hasil = 1

        return round(hasil,3)

    def kuning1(sensor1):
        if((sensor1 <= 88) or (sensor1 >= 168)):
            hasil = 0
        elif((sensor1 > 88) and (sensor1 < 89)):
            hasil = Decimal((sensor1 - 88)/(89-88))
        elif((sensor1 > 167) and (sensor1 < 168)):
            hasil = Decimal((168 - sensor1)/(168-167))
        else:
            hasil = 1

        return round(hasil,3)

    def jingga1(sensor1):
        
        if((sensor1 <= 167) or (sensor1 >= 565)):
            hasil = 0
        elif((sensor1 > 167) and (sensor1 < 168)):
            hasil = Decimal((sensor1 - 167)/(168-167))
        elif((sensor1 > 564) and (sensor1 < 565)):
            hasil = Decimal((565 - sensor1)/(565-564))
        else:
            hasil = 1
        return round(hasil,3)

    def merah1(sensor1):
        if(sensor1<=564):
            hasil = 0
        elif((sensor1>564) and (sensor1<565)):
            hasil = Decimal((sensor1 - 564)/(565-564))
        else:
            hasil = 1
        return round(hasil,3)

    #================FUZZIFIKASI SENSOR 2==================

    def putih2(sensor2):
        if(sensor2 >= 2.9):
            hasil = 0
        elif((sensor2 > 2.8) and (sensor2 < 2.9)):
            hasil = Decimal((2.9 - sensor2)/(2.9-2.8))
        else:
            hasil = 1
        return round(hasil,3)

    def hijau2(sensor2):
        
        if((sensor2 <= 2.8) or (sensor2 >= 89)):
            hasil = 0
        elif((sensor2 > 2.8) and (sensor2 < 2.9)):
            hasil = Decimal((sensor2 - 2.8)/(2.9-2.8))
        elif((sensor2 > 88) and (sensor2 < 89)):
            hasil = Decimal((89 - sensor2)/(89-88))
        else:
            hasil = 1

        return round(hasil,3)

    def kuning2(sensor2):

        if((sensor2 <= 88) or (sensor2 >= 168)):
            hasil = 0
        elif((sensor2 > 88) and (sensor2 < 89)):
            hasil = Decimal((sensor2 - 88)/(89-88))
        elif((sensor2 > 167) and (sensor2 < 168)):
            hasil = Decimal((168 - sensor2)/(168-167))
        else:
            hasil = 1

        return round(hasil,3)

    def jingga2(sensor2):
        
        if((sensor2 <= 167) or (sensor2 >= 565)):
            hasil = 0
        elif((sensor2 > 167) and (sensor2 < 168)):
            hasil = Decimal((sensor2 - 167)/(168-167))
        elif((sensor2 > 564) and (sensor2 < 565)):
            hasil = Decimal((565 - sensor2)/(565-564))
        else:
            hasil = 1
        return round(hasil,3)

    def merah2(sensor2):
        if(sensor2<=564):
            hasil = 0
        elif((sensor2>564) and (sensor2<565)):
            hasil = Decimal((sensor2 - 564)/(565-564))
        else:
            hasil = 1
        return round(hasil,3)

    #================FUZZIFIKASI SENSOR 3==================

    def putih3(sensor3):
        if(sensor3 >= 2.9):
            hasil = 0
        elif((sensor3 > 2.8) and (sensor3 < 2.9)):
            hasil = Decimal((2.9 - sensor3)/(2.9-2.8))
        else:
            hasil = 1
        return round(hasil,3)

    def hijau3(sensor3):
        
        if((sensor3 <= 2.8) or (sensor3 >= 89)):
            hasil = 0
        elif((sensor3 > 2.8) and (sensor3 < 2.9)):
            hasil = Decimal((sensor3 - 2.8)/(2.9-2.8))
        elif((sensor3 > 88) and (sensor3 < 89)):
            hasil = Decimal((89 - sensor3)/(89-88))
        else:
            hasil = 1

        return round(hasil,3)

    def kuning3(sensor3):

        if((sensor3 <= 88) or (sensor3 >= 168)):
            hasil = 0
        elif((sensor3 > 88) and (sensor3 < 89)):
            hasil = Decimal((sensor3 - 88)/(89-88))
        elif((sensor3 > 167) and (sensor3 < 168)):
            hasil = Decimal((168 - sensor3)/(168-167))
        else:
            hasil = 1

        return round(hasil,3)

    def jingga3(sensor3):
        if((sensor3 <= 167) or (sensor3 >= 565)):
            hasil = 0
        elif((sensor3 > 167) and (sensor3 < 168)):
            hasil = Decimal((sensor3 - 167)/(168-167))
        elif((sensor3 > 564) and (sensor3 < 565)):
            hasil = Decimal((565 - sensor3)/(565-564))
        else:
            hasil = 1
        return round(hasil,3)

    def merah3(sensor3):
        if(sensor3<=564):
            hasil = 0
        elif((sensor3>564) and (sensor3<565)):
            hasil = Decimal((sensor3 - 564)/(565-564))
        else:
            hasil = 1
        return round(hasil,3)


    def menampilkanFuzzy():

        for i in range(0,5):
            if(nilaiSensor1[i] > 0):
                print('Sensor 1: ',namaSensor1[i],'\t= ',nilaiSensor1[i])
                
        for i in range(0,5):
            if(nilaiSensor2[i] > 0):
                print('Sensor 2: ',namaSensor2[i],'\t= ',nilaiSensor2[i])
                
        for i in range(0,5):
            if(nilaiSensor3[i] > 0):
                print('Sensor 3: ',namaSensor3[i],'\t= ',nilaiSensor3[i])




    def inferensi():
        x = 0
        maxgempa = 0
        maxtidakgempa = 0
    #============================================LOOPING===============================================#
        for i in range(0,5):
            for j in range(0,5):
                for k in range(0,5):
        #========================================MIN===========================================#
                    if((nilaiSensor1[i]>0) and (nilaiSensor2[j]>0) and (nilaiSensor3[k]>0)):
                        
                        if(nilaiSensor1[i] <= nilaiSensor2[j] and nilaiSensor1[i] <= nilaiSensor3[k]): 
                            nilaiKondisi[x] = nilaiSensor1[i]
                        elif(nilaiSensor2[j] <= nilaiSensor1[i] and nilaiSensor2[j] <= nilaiSensor3[k]): 
                            nilaiKondisi[x] = nilaiSensor2[j]
                        else: 
                            nilaiKondisi[x] = nilaiSensor3[k]
    #=======================================Rules=============================================#
                    if(j>=3 and k>=3):
                        status[x] = "Gempa"
                    else:
                        if(i>=3 and k>=3):
                            status[x] = "Gempa"
                        else:
                            if(i>=3 and j>=3):
                                status[x] = "Gempa"
                            else:
                                status[x] = "TidakGempa"
        
        #======================================= X Tambah 1 ======================================#
    
                    if(nilaiKondisi[x]>0):
                        print("Sensor 1 = ", namaSensor1[i], "& Sensor 2 = ", namaSensor2[j], "& Sensor 3 = ", namaSensor3[k], "Maka Status = ", status[x], "\t\t= ", nilaiKondisi[x])
                    x += 1
                    
        #========================================MAXIMUM=========================================#
        for i in range (0,x):
            if(nilaiKondisi[i]>0):
                if(status[i]=="Gempa"):
                    if(maxgempa<nilaiKondisi[i]):
                        maxgempa = nilaiKondisi[i]
                else:
                    if(maxgempa<nilaiKondisi[i]):
                        maxtidakgempa = nilaiKondisi[i]
        print("\nMax Gempa: ", maxgempa)
        print("Max Tidak Gempa: ", maxtidakgempa)
        
        return(maxgempa, maxtidakgempa)



    def defuzzifikasi(maxgempa, maxtidakgempa):
        
        gempa = float(maxgempa)
        tidak = float(maxtidakgempa)
        
        sampel = 10
        pembilang = 0.0
        penyebut = 0.0

        penyebuttdkgempa = 0
        penyebutgempa = 0
        delta = float(100/sampel)

        pointer = delta

        for i in range (0, sampel):
            if(pointer <= 40):
                pembilang = float(pembilang + (pointer * tidak))
                penyebut += tidak

            elif(pointer >= 60):
                pembilang = float(pembilang + (pointer * gempa))
                penyebut+= gempa

            else:
                if(tidak > gempa):
                    pembilang += float((pointer * ((60 - pointer)/20)))
                    penyebut += (60 - pointer)/20

                else:
                    pembilang += float((pointer * ((pointer - 40)/20)))
                    penyebut += ((pointer - 40)/20)

            pointer+=delta
        
        print("Pembilang: ", pembilang)
        print("Penyebut: ", penyebut)
        
        hasil = pembilang/penyebut
        return hasil

    def main(pga1, pga2, pga3):
        sensor1 = pga1
        sensor2 = pga2
        sensor3 = pga3
        
        nilaiSensor1[0] = putih1(sensor1)
        nilaiSensor1[1] = hijau1(sensor1)
        nilaiSensor1[2] = kuning1(sensor1)
        nilaiSensor1[3] = jingga1(sensor1)
        nilaiSensor1[4] = merah1(sensor1)
        
        nilaiSensor2[0] = putih2(sensor2)
        nilaiSensor2[1] = hijau2(sensor2)
        nilaiSensor2[2] = kuning2(sensor2)
        nilaiSensor2[3] = jingga2(sensor2)
        nilaiSensor2[4] = merah2(sensor2)
        
        nilaiSensor3[0] = putih3(sensor3)
        nilaiSensor3[1] = hijau3(sensor3)
        nilaiSensor3[2] = kuning3(sensor3)
        nilaiSensor3[3] = jingga3(sensor3)
        nilaiSensor3[4] = merah3(sensor3)
        
        
        #print ('\n================================= FUZZIFIKASI ==================================\n')
        menampilkanFuzzy()
        
        #print("========================================INFERENSI==================================\n")
        maxgempa, maxtidakgempa = inferensi()
        
        
        #print("=====================================DEFUZZIFIKASI==================================\n")
        hasil = defuzzifikasi(maxgempa, maxtidakgempa)
        print("hasil akhir: ", round(hasil,2))
        
        if(hasil<=50):
            #print("0")
            out = 0
        else:
            out = 1

        tanggal = today.strftime("%Y/%m/%d")
        waktu = time.strftime("%H:%M:%S", t)
        
        return out, tanggal, waktu

    test,tanggal, waktu = main(pga1, pga2, pga3)
    return test, tanggal, waktu

