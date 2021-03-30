<form name="sepetform" method="post" action="index.php?lx=sepet.php">
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Stok</th>
                        <th>Miktar</th>
                        <th class="text-center">Fiyat</th>
                        <th class="text-center">Tutar</th>
                        <th>Sil</th>
                        <th>Arttır</th>
                        <th>Eksilt</th>
                    </tr>
                </thead>
                <tbody>
             
                    <tr>
                        <td class="col-sm-8 col-md-6">
                        <div class="media">
                            <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#"> _Stokad</a></h4>
                                <h5 class="media-heading"> by <a href="#"> _StokGrupKod</a></h5>
                                <span>Miktar: </span><span class="text-success"><strong> _BakiyeMiktar_</strong></span>
                            </div>
                        </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        _miktar_
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong><?=$ds->fiyat?></strong></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong><?=$ds->tutar?></strong></td>
                        <td class="col-sm-1 col-md-1">                       
                            <span class="glyphicon glyphicon-remove"></span><a href="./?lx=sepet.php&sepetsil=_sepetid_" class="btn btn-primary">Sil</a>
                        </td>
                        <td class="col-sm-1 col-md-1">
                            <span class="glyphicon glyphicon-remove"></span><a href="./?lx=sepet.php&sepetarttir=_sepetid_" class="btn btn-primary">+</a>
                        </td>
                        <td class="col-sm-1 col-md-1">
                       
                            <span class="glyphicon glyphicon-remove"></span><a href="./?lx=sepet.php&sepeteksilt=_sepetid_" class="btn btn-primary">-</a>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>Genel Toplam</h3></td>
                        <td class="text-right"><h3><strong>__toplam ₺</strong></h3></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>
                            <button type="submit" name="siparisbuton" id="siparisbuton" value="Siparisvar" class="btn btn-success">Sipariş</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</form>