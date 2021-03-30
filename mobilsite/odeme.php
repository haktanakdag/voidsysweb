<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<style>

table {
  border: 0;
  width: 90%;
  margin: 0;
  padding: 0;
  border-collapse: collapse;
  border-spacing: 0;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
}
table thead {
  background: #F0F0F0;
  height: 60px !important;
}
table thead tr th:first-child {
  padding-left: 45px;
}
table thead tr th {
  text-transform: uppercase;
  line-height: 60px !important;
  text-align: left;
  font-size: 11px;
  padding-top: 0px !important;
  padding-bottom: 0px !important;
}
table tbody {
  background: #fff;
}
table tbody tr {
  border-top: 1px solid #e5e5e5;
  height: 60px;
}
table tbody tr td:first-child {
  padding-left: 45px;
}
table tbody tr td {
  height: 60px;
  line-height: 60px !important;
  text-align: left;
  padding: 0 10px;
  font-size: 14px;
}
table tbody tr td i {
  margin-right: 8px;
  margin-top: 14px;
}


@media screen and (max-width: 800px) {
  table {
    border: 1px solid transparent;
    box-shadow: none;
  }
  table thead {
    display: none;
  }
  table tbody tr {
    border-bottom: 45px solid #F8F8F8;
  }
  table tbody tr td:first-child {
    padding-left: 10px;
  }
  table tbody tr td:before {
    content: attr(data-label);
    float: left;
    font-size: 10px;
    text-transform: uppercase;
    font-weight: bold;
  }
  table tbody tr td {
    display: block;
    text-align: right;
    font-size: 14px;
    padding: 0px 10px !important;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
  }
}
</style>

  <script>
  window.console = window.console || function(t) {};
</script>

  
  
  <script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>


<body translate="no">
  <div class="container" id="siparis">
  <h2>Sipariş Bilgileri</h2>            
  <table class="table">
    <thead>
      <tr>
        <th>Ürünler</th>
        <th>Fiyat</th>
        <th>Miktar</th>
        <th>Tutar</th>
        <th>Arttır</th>
        <th>Eksilt</th>
        <th>Sil</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Hamburger</td>
        <td>30 ₺</td>
        <td>2 Ad</td>
        <td>60 ₺</td>
        <td><a href="#" class="text-dark"><i class="fa fa-minus-square"></i></a></td>
        <td><a href="#" class="text-dark"><i class="fa fa-plus-square"></i></a></td>
        <td><a href="#" class="text-dark"><i class="fa fa-trash"></i></a></td>
      </tr>
    </tbody>
  </table>
</div>
      <div class="row py-5 p-4 bg-white rounded shadow-sm" id="hesap">
        
        <div class="col-lg-6">
          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Toplam Tutar</div>
          <div class="p-4">
            <p class="font-italic mb-4">Siparişinizin Toplam Tutarı aşağıdaki gibidir. Ödemenizi Temazsız bir şekilde online kredi kartı ile ödeyebilirsiniz.</p>
            <ul class="list-unstyled mb-4">
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Toplam Tutar </strong><strong>200 ₺</strong></li>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Ödenen Tutar</strong><strong>100 ₺</strong></li>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Ödenmesi Gereken Tutar</strong><strong>100 ₺</strong></li>
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                <h5 class="font-weight-bold">200 ₺</h5>
              </li>
          </div>
        </div>
          <div class="col-lg-6">
          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Sipariş Bilgileri</div>
          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">
   
      <div class="container">

        <div class="section-header">
          <p>Sipariş Notlarınızı ve size ulaşabileceğimiz bilgilerinizi burada beliriniz.</p>
        </div>

        

        <div class="form">
          <div id="sendmessage">Sipariş Notunuz ve İletişim Bilgileriniz.</div>
          <div id="errormessage"></div>
          <form action="" method="post" role="form" class="contactForm">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control" id="name" placeholder="Ad Soyad" data-rule="minlen:4" data-msg="Gerekli" />
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-6">
                <input type="text" name="telefon" class="form-control" id="name" placeholder="Telefon" data-rule="minlen:4" data-msg="Gerekli" />
                <div class="validation"></div>
              </div>
            </div>
              <div class="form-row">
              <div class="form-group col-md-12">
                <input type="email" class="form-control" name="email" id="email" placeholder="e-posta" data-rule="email" data-msg="E-Posta Gerekli" />
                <div class="validation"></div>
              </div>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="siparisnotu" rows="5" placeholder="Sipariş Notu"></textarea>
              <div class="validation"></div>
            </div>
            <div class="text-center"><button type="submit">Gönder</button></div>
          </form>
        </div>

      </div>
  </div>
        </div>
      </div>


<!--<div class="row contact-info">
          <div class="col-md-4">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h5>Adres:</h5>
              <address>Hasanefendi (Ramazan Paşa) Mah. 1911 Sk. No:6/1 EFELER - AYDIN</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h5>Phone Number</h5>
              <p><a href="tel:+155895548855">+90 555 663 49 87</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h5>Email</h5>
              <p><a href="mailto:info@example.com">siparis@bw.com</a></p>
            </div>
          </div>

        </div>-->