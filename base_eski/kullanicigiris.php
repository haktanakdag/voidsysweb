<div class="container">
<ul class="accordion css-accordion">
            <li class="accordion-item">
            <input class="accordion-item-input" type="checkbox" name="accordion" id="item1" checked="checked" />
            <label for="item1" class="accordion-item-hd">Üye giriş<span class="accordion-item-hd-cta">&#9650;</span></label>
            <div class="accordion-item-bd">
      <?=$girishatali?>
      <div class="col">
        <a href="../FacebookLogin/loginFB.php" class="fb btn">
            <i class="fa fa-facebook fa-fw"></i> Login with Facebook
         </a>
        <a href="../TwitterLogin/index.php" class="twitter btn">
          <i class="fa fa-twitter fa-fw"></i> Login with Twitter
        </a>
          <a href="../GoogleLogin/index.php" class="google btn"><i class="fa fa-google fa-fw">
          </i> Login with Google+
        </a>
      </div>
  
<form action="./">     
    <div class="col">
     <input type="text" name="admin" placeholder="Username" required>
     <input type="password" name="sifre" placeholder="Password" required>
     <input type="submit" class="w3-button w3-black w3-margin-bottom"  name ="giris" value="Giriş">
    </div>
</form> 

            </div>
            </li>
            <li class="accordion-item">
            <input class="accordion-item-input" type="checkbox" name="accordion" id="item2" />
            <label for="item2" class="accordion-item-hd">Üye ol <span class="accordion-item-hd-cta">&#9650;</span></label>
<div class="accordion-item-bd">
<form action="./"> 
<label for="email"><b>Email</b></label>
<input type="text" placeholder="Enter Email" name="email" required>

<label for="psw"><b>Password</b></label>
<input type="password" placeholder="Enter Password" name="psw" required>

<label for="psw-repeat"><b>Repeat Password</b></label>
<input type="password" placeholder="Repeat Password" name="psw-repeat" required>
<input type="checkbox" name="sozlesme" id="sozlesme" required/>
<script type="text/javascript">

hs.graphicsDir = '../highslide/graphics/';
hs.outlineType = 'rounded-white';
hs.wrapperClassName = 'draggable-header';

</script>

<p>Üyelik Sözleşmesini okudum onaylıyorum <a href="uyeliksozlesmesi.html" onclick="return hs.htmlExpand(this, { objectType: 'ajax'} )">Sözleşme</a>.</p> 
<div class="clearfix">
<input type="submit" class="w3-button w3-black w3-margin-bottom" name ="kayitol" value="Kayıt ol">
</div>
</form>
</div>
</li>
<li class="accordion-item">
<form action="./"> 
<input class="accordion-item-input" type="checkbox" name="accordion" id="item3" />
<label for="item3" class="accordion-item-hd">Şifremi Unuttum<span class="accordion-item-hd-cta">&#9650;</span></label>
<div class="accordion-item-bd"> 
<label for="email"><b>Email</b></label>
<input type="text" placeholder="Enter Email" name="email" required>
<div class="clearfix">
<input type="submit" class="w3-button w3-black w3-margin-bottom"  name ="sifremiunuttum" value="Kayıt ol">
</div>
</div>
</form>
</li>
</ul>  
</div>