# OpenWeatherMap

Согласно макету требуется получить:
- Название города, для которого запросили данные
- Температуру
- Описание погоды (дождь/солнечно/пасмурно)
- Иконку, отражающую текущую погоду
- Скорость ветра
- Давление
- Влажность
- Вероятность осадков

## Компоненты
`Services/ApiClient` — общий родительский класс для всех внешних интеграций  
`Services/WeatherClient` — клиент для отправки запросов к [OpenWeather](https://openweathermap.org/current)  


`Services/WeatherDtoFactory` — парсинг ответа и создание DTO на его основе  
`Services/WeatherRequestParams` — класс с параметрами запроса  
`Dto/CurrentWeatherDto` — DTO для ответа на запрос

`Enums/WeatherMode` — доступные форматы ответа  
`Enums/WeatherUnits` — доступные единицы измерения

`config/openweathermap` — основная конфигурация для клиента

## Маршруты
`/api/weather` — получение данных о погоде по указанному городу
`/api/documentation` — Swagger
