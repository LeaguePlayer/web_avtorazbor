<h3>
	Дата поступлениея заказа <?=date('d-m-y',time($data->create_time))?>, Текущее состояние: <?=Requests::getStatusAliases($data->status)?>
</h3>
<div class="">
	<div class="bascet tab-active" id="cart">
        				<table width="100%">
        					<thead>
        						<tr>
        							<th width="235px">
        								Фото
        							</th>
                                    <th>
                                            Артикул
                                    </th>
        							<th>
        								Название
        							</th>
        							<th>
        								Цена
        							</th>
        							
        							<th width="24px">

        							</th>	
        						</tr>
        					</thead>

        					<tbody>
                            <?
                                    foreach ($data->parts as $key => $item) {
                                            print($this->renderPartial('_bookListItem',array('data'=>$item),true));
                                    }
                            ?>
        					</tbody>
        				</table>
        			</div>
</div>