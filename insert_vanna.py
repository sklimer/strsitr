import json
import mysql.connector
from mysql.connector import Error

# Конфигурация подключения
DB_CONFIG = {
    'host': 'sklimedw.beget.tech',
    'user': 'sklimedw_strsity',
    'password': 'y80jI&Gz8Qui',
    'database': 'sklimedw_strsity',
    'use_pure': True,
    'ssl_disabled': True
}

JSON_FILE = 'data.json'  # файл с данными (теперь включает поле "ссылка на карточку товара")

# SQL для создания таблицы (если не существует)
CREATE_TABLE_SQL = """
CREATE TABLE IF NOT EXISTS NewVanna (
    id INT AUTO_INCREMENT PRIMARY KEY,
    article VARCHAR(50) NOT NULL,
    title VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(500) NOT NULL,
    card_url VARCHAR(500) NOT NULL DEFAULT '',   -- новое поле
    length INT NOT NULL,
    width INT NOT NULL,
    height INT NOT NULL,
    depth INT NOT NULL,
    volume INT NOT NULL,
    bath_type VARCHAR(100) NOT NULL,
    screen_mount VARCHAR(100) NOT NULL,
    production BOOLEAN NOT NULL DEFAULT TRUE,
    in_stock BOOLEAN NOT NULL DEFAULT TRUE,
    active BOOLEAN NOT NULL DEFAULT TRUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
"""

# SQL для вставки данных (добавлен card_url)
INSERT_SQL = """
INSERT INTO NewVanna 
(article, title, price, image_url, card_url, length, width, height, depth, volume, bath_type, screen_mount, production, in_stock, active)
VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
"""

def convert_to_int(value):
    """Преобразует строку в целое число, если возможно."""
    if value is None:
        return 0
    try:
        # Убираем возможные пробелы и нецифровые символы, кроме цифр
        cleaned = ''.join(ch for ch in str(value) if ch.isdigit())
        return int(cleaned) if cleaned else 0
    except:
        return 0

def convert_to_float(value):
    """Преобразует строку в число с плавающей точкой."""
    if value is None:
        return 0.0
    try:
        cleaned = ''.join(ch for ch in str(value) if ch.isdigit() or ch == '.')
        return float(cleaned) if cleaned else 0.0
    except:
        return 0.0

def main():
    connection = None
    cursor = None
    try:
        # Подключение к MySQL
        connection = mysql.connector.connect(**DB_CONFIG)
        cursor = connection.cursor()
        print("Подключение к MySQL успешно.")

        # Создание таблицы (если столбец card_url уже существует, запрос не сломается)
        cursor.execute(CREATE_TABLE_SQL)
        print("Таблица NewVanna создана/проверена.")

        # Загрузка данных из JSON
        with open(JSON_FILE, 'r', encoding='utf-8') as f:
            data = json.load(f)
        print(f"Загружено {len(data)} записей из JSON.")

        # Подготовка данных для вставки
        insert_data = []
        for item in data:
            article = item.get('Артикул', '')
            title = item.get('Название', '')
            price = convert_to_float(item.get('Цена', 0))
            image_url = item.get('ссылка на изображение товара', '')
            card_url = item.get('ссылка на карточку товара', '')   # извлекаем новое поле
            length = convert_to_int(item.get('Длина', 0))
            width = convert_to_int(item.get('Ширина', 0))
            height = convert_to_int(item.get('Высота', 0))
            depth = convert_to_int(item.get('Глубина', 0))
            volume = convert_to_int(item.get('Объем', 0))
            bath_type = item.get('Тип ванны', '')
            screen_mount = item.get('Крепление экрана', '')
            production = bool(item.get('Производство', True))
            in_stock = bool(item.get('Наличие', True))
            active = bool(item.get('Активный', True))

            insert_data.append((
                article, title, price, image_url, card_url,
                length, width, height, depth, volume,
                bath_type, screen_mount,
                production, in_stock, active
            ))

        # Массовая вставка
        cursor.executemany(INSERT_SQL, insert_data)
        connection.commit()
        print(f"Вставлено записей: {cursor.rowcount}")

    except FileNotFoundError:
        print(f"Ошибка: файл {JSON_FILE} не найден.")
    except json.JSONDecodeError as e:
        print(f"Ошибка в JSON: {e}")
    except Error as e:
        print(f"Ошибка MySQL: {e}")
        if e.errno == 1045:
            print("Неверный логин или пароль.")
        elif e.errno == 1049:
            print("База данных не существует.")
        elif e.errno == 2003:
            print("Не удаётся подключиться к серверу MySQL. Проверьте, запущен ли сервер.")
    except Exception as e:
        print(f"Неожиданная ошибка: {e}")
    finally:
        if cursor:
            cursor.close()
        if connection and connection.is_connected():
            connection.close()
            print("Соединение с БД закрыто.")

if __name__ == '__main__':
    main()