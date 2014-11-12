<tr>
        <?      
        $gallery= $data->getGallery()->galleryPhotos;
        $image = $gallery ? $gallery[0]->getUrl('small') : '/media/images/default.png';
        $imageBig = $gallery ? $gallery[0]->getUrl('big') : '/media/images/defaultBig.png';
        // $image='/media/_viewSmall.png';
        // $imageBig='/media/car.png';

        ?>
	<td>
            <a href="<?=$imageBig?>" class="imgFancy" rel="1">
		      <img src="<?=$image?>" alt="" title="" />
            </a>
	</td>
        <td class="articul">
                <?=$data->id?>
        </td>
	<td>
		<ul>
			<li>
				<a href="/detail/<?=$data->url?>/<?=$data->id?>">
					<?=$data->name?>
				</a>
			</li>
			<li>
				Модель авто: <?=$data->car_model->name?>
			</li>
			<li>
				Volvo FH с 2008г 
			</li>
		</ul>
	</td>
	<td>
		<?=number_format($data->getSumPrice(),0,' ',' ')?> руб.
	</td>
	<td>
		<input type="submit" name="close" value="" class="i-close"/>
	</td>
</tr>