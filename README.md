## 🛠 Установка и запуск

Для запуска проекта вам понадобится установленный **Docker Desktop**.

1. **Клонируйте проект и перейдите в папку:**
   ```bash
   cd boss-api
   ```

2. **Соберите и запустите контейнеры:**
   ```bash
   docker-compose up -d --build
   ```

3. **Установите зависимости (если папка vendor отсутствует):**
   ```bash
   docker-compose exec app composer install
   ```

4. **Настройте переменные окружения:**
   Скопируйте `.env.example` в `.env` и убедитесь, что параметры БД верны:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=db
   DB_PORT=3306
   DB_DATABASE=boss_db
   DB_USERNAME=root
   DB_PASSWORD=root
   ```

5. **Запустите миграции:**
   ```bash
   docker-compose exec app php artisan migrate
   ```

6. **Настройте права доступа (при необходимости):**
   ```bash
   docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
   docker-compose exec app chmod -R 775 storage bootstrap/cache
   ```

Проект будет доступен по адресу: `http://localhost:8080`

## 📡 API Эндпоинты

Все запросы должны содержать заголовок `Accept: application/json`.

| Метод  | Эндпоинт              | Описание                          |
|--------|-----------------------|-----------------------------------|
| GET    | `/api/resumes`        | Получить список всех резюме (пагинация 15) |
| POST   | `/api/resumes`        | Создать новое резюме             |
| GET    | `/api/resumes/{id}`   | Получить детальную информацию     |
| PUT    | `/api/resumes/{id}`   | Обновить существующее резюме      |
| DELETE | `/api/resumes/{id}`   | Удалить резюме                    |

### Пример JSON для создания (POST):
```json
{
    "full_name": "Ali Aliyev",
    "email": "ali@example.com",
    "phone": "+994501112233",
    "position": "PHP Developer",
    "category": "IT",
    "description": "Senior Developer with 5 years of experience",
    "salary": 2500,
    "education": "bachelor",
    "experience": "mid",
    "skills": ["PHP", "Laravel", "MySQL"]
}
```