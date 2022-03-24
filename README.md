<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<h1>Wallet App</h1>

<h2>To load data in sqlite database </h2>
run <h5>php artisan migrate:fresh --seed</h5>

two users:
<h5>sagar@gmail.com</h5>
<h5>adam@gmail.com</h5>
<h2>Endpoints </h2>

<h3>auth/api/login</h3>:"post request for login that return token "

<h3>auth/api/signup</h3>:"post request for register user that return token "

<h3>/api/deposit</h3>:"post request for deposit amount  "

request formData=['amount'=>100]

<h3>/api/send</h3>:"post request for trasnsfering amount "

request formData=['amount'=>100,'receiver_email'=>"adam@email.com"]


<h3>/api/transactions</h3>:"get request for trasnsfer history "







