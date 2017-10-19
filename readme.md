# Tienda de prueba Webpay One Click
Librería para la integración de Webpay Plus, Webpay OneClick y Webpay Patpass. Esta librería es mantenida por Gonzalo De Spirito de [freshworkstudio.com](http://freshworkstudio.com) y [simplepay.cl](http://simplepay.cl).

![Freshwork Studio's Transbank SDK](https://cloud.githubusercontent.com/assets/1103494/16623124/b0082046-436a-11e6-870a-2e5f6dbd9ef8.jpg)
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></img></a>


# Installation
```bash
git clone git@github.com:freshworkstudio/demo-store.git
cd demo-store
composer install --prefer-dist
cp .env.example .env
php artisan key:generate
```

Luego debes configurar tu base de datos en el `.env` y después correr las migraciones

```bash
php artisan migrate
```

# Usage
Luego de instalar, cargara una tienda con productos de prueba. 

#Flow
- Entrar a la tienda
- Agregar al carro
- Ver el carro
- Regístrarte como usuario o iniciar sesión. Es importante destacar que para webpay one click el usuario debe estar registrado ya que su tarjeta de crédito queda asociada a un nombre de usuario dentro de tu base de datos. No puede comprar anónimamente como con Webpay PLus. 
- Al registrarte por primera vez, el usuario no tendrá una tarjeta de crédito asociada a su cuenta. Le ofrecemos agregarla para pagar. 
- El usuario agrega su tarjeta
- Las futuras compras del usuario, solo requiere hacer click sore el botón de pago y sin pasar por el flujo de tranbank, banco ni claves, la compra será aprobada. 


### Pedir al usuario que  agregue su tarjeta

![image](https://user-images.githubusercontent.com/1103494/31772369-d9609532-b4b5-11e7-86c4-6e6a5407c37e.png)

### Agregando tarjeta
```
VISA: 4051885600446623
Vencimimento: Cualquiera
Codigo verificación: 123
```
![image](https://user-images.githubusercontent.com/1103494/31772563-7dfab168-b4b6-11e7-9d13-eea2f45ab914.png)

```
RUT: 11.111.111-1
Clave: 123
```
![image](https://user-images.githubusercontent.com/1103494/31772606-9dd648bc-b4b6-11e7-848c-5a4a891eaf96.png)

### Tarjeta agregada
Ahora el usuario puede pagar con un solo click porque su tarjeta de crédito ya está grabada. 
![image](https://user-images.githubusercontent.com/1103494/31772659-cb2d13ae-b4b6-11e7-86b2-ab00e3e3bde7.png)

# Pagar con webpay one click
Solo apretar el botón y pagar... 
![gif](http://g.recordit.co/N9c5vMWduM.gif)

