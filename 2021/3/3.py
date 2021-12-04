with open('input.txt') as data:
    numbers = list(map(lambda x: x.strip(), data.readlines()))

w = len(list(numbers[0]))

import numpy as np

numbers_split = []

for n in numbers:
    cells = list(n)
    numbers_split.append(cells)

report = np.array(numbers_split, dtype = int)

report_short = report[:]
report_tmp = []

for i in range(w):
    average = np.average(report_short, axis = 0)
    for line in report_short:
        if (((average[i] >= 0.5) and (line[i] == 1)) or ((average[i] < 0.5) and (line[i] == 0))):
            report_tmp.append(line)
    report_short = report_tmp[:]
    report_tmp = []
    if len(report_short) == 1:
        print('success!')
        break
    
oxygen = report_short[0]
print(oxygen)

report_short = report[:]
report_tmp = []

for i in range(w):
    average = np.average(report_short, axis = 0)
    for line in report_short:
        if ((average[i] < 0.5) and (line[i] == 1)) or ((average[i] >= 0.5) and (line[i] == 0)):
            report_tmp.append(line)
    report_short = report_tmp[:]
    report_tmp = []
    if len(report_short) == 1:
        print('success!')
        break
    
CO2 = report_short[0]
print(CO2)

oxygen = int(str(''.join(oxygen.astype(str))), 2)
CO2 = int(str(''.join(CO2.astype(str))), 2)

oxygen*CO2