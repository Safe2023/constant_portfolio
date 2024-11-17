<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>



<style>
  .contact-section .contact-info p {
    font-weight: 600;
    color: #000000;
    margin-bottom: 0;
  }

  .contact-section .contact-info p a {
    color: #1a1a1a;
  }

  .contact-section .contact-info p span {
    display: block;
    font-size: 16px;
    font-weight: 400;
    color: #999999;
  }

  .contact-section .icon {
    margin-top: 10px;
  }

  .contact-section .contact-info .icon span {
    font-size: 20px;
    color: #F7921D;
  }

  @media (min-width: 992px) {
    .contact-section .contact-info .border-height {
      border-left: 1px solid rgba(0, 0, 0, 0.1);
      border-right: 1px solid rgba(0, 0, 0, 0.1);
    }
  }

  .contact-section .contact-form {
    width: 100%;
  }

  .mes {
    color: #fc9400;
  }

  .mes:hover {
    color: #161616;
  }
  
</style>

<div class="back-to-top"></div>

<div class="container" style="background: url(''); background-size: cover;">
  <div class="page-banner">
    <div class="row justify-content-center align-items-center h-500">
      <div class="col-md-6" style=" margin-top:172px;">
        <nav aria-label="Breadcrumb ">
          <ul class="breadcrumb justify-content-center py-0 bg-transparent   ">
            <li class="breadcrumb-item"><a href="/welcome" class="text-white" style="font-weight: 900;">Accueil</a></li>
            <li class="breadcrumb-item active text-white">Contact</li>
          </ul>
        </nav>
        <h1 class="text-center text-white ">Nous contactez</h1>
      </div>
    </div>
  </div>
</div>


<div class="container">
  <div class="row justify-content-center mb-2 mt-5  bg-light">
    <div class="heading_container col-md-7 text-center heading-section ftco-animate mb-3">
      <h2 class="text-center mt-3 ">
        <span>Contactez-nous</span>
      </h2>
      <p>Vous aviez la possibilité de nous contacter pour demander des informations sur un produit/service spécifique.Nous somme disponible 24h/24 7j/7 pour repondre a votre préocupations.</p>

    </div>
  </div>
</div>
<section class="ftco-section contact-section mt-3">
  <div class="container">
    <div class="row d-flex mb-5 contact-info">

      <div class="col-md-4">
        <div class="row mb-3">
          <div class="col-md-12">
            <div class="border w-100 p-4 rounded mb-2 d-flex">
              <div class="icon mr-3">
                <i class="bi bi-geo-alt-fill mes"></i>
              </div>
              <p><span>Address:</span>Abomey-calavi/Benin</p>
            </div>
          </div>
          <div class="col-md-12">
            <div class="border w-100 p-4 rounded mb-2 d-flex">
              <div class="icon mr-3">
                <i class="bi bi-telephone-fill mes"></i>
              </div>
              <p><span>Phone:</span> <a href="tel://0022940360670">+ 229 40360670</a></p>
            </div>
          </div>
          <div class="col-md-12">
            <div class="border w-100 p-4 rounded mb-2 d-flex">
              <div class="icon mr-3">
                <i class="bi bi-envelope-at-fill mes"></i>
              </div>
              <p><span>Email:</span> <a href="atmaxtransport@gmail.com">dansou@gmail.com</a></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8 block-9 mb-md-5">
        <form action="" class="bg-light p-5 contact-form" method="post">
          @csrf
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Votre Nom " name="nom">
          </div>
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Votre Email" name="email">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Sujet" name="sujet">
          </div>
          <div class="form-group">
            <textarea name="message" id="" cols="30" rows="4" class="form-control" placeholder="Message"></textarea>
          </div>
          <div class="form-group">
            <input type="submit" value="Envoyer votre message" class="btn btn-success py-3 px-5 modal1" >
          </div>
        </form>

      </div>
    </div>

  </div>
</section>

</body>
</html>