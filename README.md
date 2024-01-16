<img width="2240" alt="Screenshot 2024-01-16 at 18 05 14" src="https://github.com/andreev02/test-task/assets/29811269/64d0712e-959b-4d4c-9774-918fd6ba3b8f">

#### Install

Copy repository

    git clone https://github.com/andreev02/test-task.git

Install composer

    composer install

Up your Docker daemon

    docker-compose up -d

Do migrations

    docker exec -ti test-task-app-1 php yii migrate

To install dump connect to mysql:

    host: 127.0.0.1
    port: 33060
    database: stage
    user: root
    password: secret

Enjoy on http://localhost/8876/orders/order
