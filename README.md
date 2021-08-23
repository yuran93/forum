# Forum Instruction

### Copying the .env file for backend
```
cp backend/.env.example backend/.env
```

## Building the project
```
docker-compose up
```

## Running migrations
```
docker-compose exec backend php artisan migrate
```

## Accessing the app
Frontend: http://localhost:8001 | Backend: http://localhost:8000

Admin Credentials: Username: admin@admin.com | Password: password
