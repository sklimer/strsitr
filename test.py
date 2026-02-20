import json

# Имена входных и выходного файлов
FIRST_JSON = 'first.json'   # первый JSON с полем "ссылка на карточку товара"
SECOND_JSON = 'data.json' # второй JSON, в который нужно добавить поле
OUTPUT_JSON = 'merged.json'

# Чтение первого JSON
with open(FIRST_JSON, 'r', encoding='utf-8') as f1:
    first_data = json.load(f1)

# Чтение второго JSON
with open(SECOND_JSON, 'r', encoding='utf-8') as f2:
    second_data = json.load(f2)

# Создаём словарь для быстрого поиска по артикулу из первого файла
first_dict = {item['Артикул']: item for item in first_data}

# Добавляем поле во второй файл
for item in second_data:
    articul = item['Артикул']
    if articul in first_dict:
        # Берём значение из соответствующей записи первого файла
        item['ссылка на карточку товара'] = first_dict[articul]['ссылка на карточку товара']
    else:
        # Если артикул не найден (на всякий случай), можно установить пустую строку или пропустить
        print(f'Предупреждение: артикул {articul} отсутствует в первом файле')
        item['ссылка на карточку товара'] = ''

# Сохраняем обновлённый второй JSON в третий файл
with open(OUTPUT_JSON, 'w', encoding='utf-8') as f3:
    json.dump(second_data, f3, ensure_ascii=False, indent=4)

print(f'Готово! Результат сохранён в {OUTPUT_JSON}')