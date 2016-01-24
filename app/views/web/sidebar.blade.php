
						<ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#tab1">Berita Terbaru</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab1">
                    <ul class="products-list product-list-in-box">
                    	<?php $berita=Berita::paginate(5);?>
                    	@foreach($berita as $row)
                    	<br>
                        <li class="item">
                            <div class="product-info">
                                <a href="{{URL::to('detail_berita/'.$row->id_berita)}}" class="product-title">{{$row->judul}}</a>
                                <span class="product-description">
                                    {{substr($row->isi,400)}}
                                </span>
                            </div>
                        </li><!-- /.item -->
                       	@endforeach
                    </ul>
                </div>
               </div>