<div class="container">
  <form action="action_page.php">
    <div class="row">
      <div class="col-25">
        <label for="fname">Adınız</label>
      </div>
      <div class="col-75">
        <input type="text" id="fname" name="firstname" placeholder="Your name..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="country">Mesleğiniz</label>
      </div>
      <div class="col-75">
        <select id="country" name="country">
          <option value="ogrenci">Öğrenci</option>
          <option value="isinsani">İş İnsanı</option>
          <option value="karisik">Karışık</option>
          <option value="issiz">İşsiz</option>
          <option value="bosver">Boşver</option>
          <option value="sanane">Sana NE</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="subject">Bize biraz kendinizden bahsedin.</label>
      </div>
      <div class="col-75">
        <textarea id="subject" name="kendindenbahset" placeholder="Karalayın" style="height:200px"></textarea>
      </div>
    </div>
    <div class="row">
      <input type="submit" value="Yolla">
    </div>
  </form>
</div>