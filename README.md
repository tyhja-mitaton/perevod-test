1. Создать сущность для переводчика. Сущность имеет поля для имени и занятости (5/2 либо выходные дни). Отображать данные переводчиков в представлении с использованием vue.js. Создать методы для установки типа занятости переводчика и выбора переводчиков по типу занятости.

3.3.```SELECT * FROM `translators` WHERE `weekend_work`=1```


3.4. ```UPDATE `translators` SET weekend_work = {1|0} WHERE id = {id}```

3.5 ```git add .
git commit -m "Changes"```

3.6 ```git push origin master```