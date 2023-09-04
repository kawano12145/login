import requests
from datetime import datetime, timedelta

def convert_weather_to_japanese(description):
    weather_map = {
        "Clear": "晴れ",
        "Partly cloudy": "晴れ時々曇り",
        "Cloudy": "曇り",
        "Overcast": "くもり",
    }
    return weather_map.get(description, description)

api_key = "1e4b8a2b4f9b4cd9a0d63016232507"
city = "Tokyo"
data = datetime.now()
weather_date = data.strftime("%Y-%m-%d")

api_url = f"http://api.weatherapi.com/v1/history.json?key={api_key}&q={city}&dt={data}"

token = "pJZTVcJDbWudz2R0usIi7I4iVVBG5NHGB2tAkc7U4If"
url = "https://notify-api.line.me/api/notify"

print("東京の５日間の気象情報：\n")



response = requests.get(api_url + weather_date)
data = response.json()

if (
        data
        and "forecast" in data
        and "forecastday" in data["forecast"]
        and data["forecast"]["forecastday"]
    ):
        weather_description = data["forecast"]["forecastday"][0]["day"]["condition"]["text"]
        max_temp = data["forecast"]["forecastday"][0]["day"]["maxtemp_c"]
        min_temp = data["forecast"]["forecastday"][0]["day"]["mintemp_c"]

        weather_description_jp = convert_weather_to_japanese(weather_description)
     
        message="""
        日付：{}
        天気：{}
        最高気温：{}
        最低気温：{}

               """.format(data,weather_description,max_temp,min_temp)

        auth={"Authorization":"Bearer "+token}
        content={"message":message}
        requests.post(url, headers=auth, data=content)