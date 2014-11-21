<tr>
        <?      
                $gallery= $data->getGallery()->galleryPhotos;
                $image = $gallery ? $gallery[0]->getUrl('small') : '/media/images/default.png';
                $imageBig = $gallery ? $gallery[0]->getUrl('big') : '/media/images/defaultBig.png';

        ?>
	<td>
        <a href="<?=$imageBig?>" rel="1" class="imgFancy">
	      <img src="<?=$image?>" alt="" title="" />
        </a>
	</td>
        <td class="articul">
                <?=$data->id?>
        </td>
	<td>
		<ul>
			<li>
				<?=$data->name?>
			</li>
			<li>
				Модель авто: <?=$data->car_model->name?>
			</li>
			<li>
				Volvo FH с 2008г 
			</li>
			<li>
				Артикул: <?=$data->id?>
			</li>
		</ul>
	</td>
	<td>
		<?=number_format($data->price_sell,0,' ',' ')?> руб.
	</td>
	
</tr>