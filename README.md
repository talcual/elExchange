

Proyecto Back Exchange

- Para poder correr el proyecto hacer un git clone.
- Ejecutar composer Install
- Ejecutar npm install
- Ejecutar npm run dev
- En otra terminal ejecutar php artisan serve

Tendra que configurar el .env con las siguientes variables adicionales.

Usar un api de exchangeratesapi.io y colocarla en el .env en la variable
 - EXCHANGE_API= 

Para configurar la URI del Webhook desde el .env agregar la variable 
 - WEBHOOK_URI="https://google.com


- Usando Sanctum para la autenticación tanto para el admin web como para el api que se consume desde el desarrollo en react.