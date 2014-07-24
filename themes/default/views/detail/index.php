<div class="page">
            <h1 class="head">
                Каталог автозапчастей и дисков
            </h1>

            <div class="wr">

                <div class="coll left">

                    <div class="tabs">
                        <ul>
                            <li class="active">
                                <a href="#light">
                                    Для легковых
                                </a>
                            </li>
                            <li>
                                <a href="#weight">
                                    Для грузовых
                                </a>    
                            </li>
                            <li>
                                <a href="#disc">
                                    Диски
                                </a>    
                            </li>
                            <li>
                                <a href="#book">
                                    Заказать деталь
                                </a>    
                            </li>
                        </ul>
                    </div>

                    <div class="content clear">

                        <div class="personal tab-active" id="light">

                            <dl class="desc">
                                <dt>
                                    Индивидуальный подбор
                                </dt>
                                <dd>
                                    Для подбора автозапчастей выберите марку, модель и раздел автомобиля.
                                </dd>
                            </dl>
                            <form class="criteria" action="/detail/parts" method="post">
                                <div class="select">
                                    <div class="item">
                                        <label for="mark"> 
                                            Марка:
                                        </label>
                                        
                                        <?=CHtml::dropDownList('carBrands','', $Brand,
                                            array(
                                            'empty'=>'Выберите марку ',
                                            'class'=>'select',
                                            'id'=>'carBrands',
                                            'ajax' => array(
                                            'type'=>'GET', //request type
                                            'dataType'=>'json',
                                            'url'=>CController::createUrl('/ajaxRequests/getCarModels'), //url to call.
                                            //Style: CController::createUrl('currentController/methodToCall')
                                            'update'=>'#carModels', //selector to update
                                            'data'=>array('value'=>'js:this.value','model'=>'CarModels'),
                                            'success'=>'function(data){
                                                $("#CarModels").closest(".item").empty().html(data);
                                                $("#CarModels").selectbox();
                                                console.log(data);
                                            }'
                                            //leave out the data key to pass all form values through
                                            ))); 
                                            //empty since it will be filled by the other dropdown
                                        ?>
                                    </div>
                                    <div class="item">
                                        <label for="model"> 
                                            Марка:
                                        </label>
                                        <?=CHtml::dropDownList('CarModels','id', array())?>
                                    </div>
                                    <div class="item">
                                        <label for="model"> 
                                            Раздел:
                                        </label>
                                        <?=CHtml::dropDownList('Categories','id', CHtml::listData(Categories::model()->findAll('parent=0'),'id','name'),
                                        array(
                                            'empty'=>'Выберите раздел',
                                            'class'=>'select',
                                            'id'=>'Categories',
                                            'ajax' => array(
                                            'type'=>'GET', //request type
                                            'dataType'=>'json',
                                            'url'=>CController::createUrl('/ajaxRequests/getSubCategories'), //url to call.
                                            //Style: CController::createUrl('currentController/methodToCall')
                                            'update'=>'#subCategoies', //selector to update
                                            'data'=>array('value'=>'js:this.value','model'=>'subCategories'),
                                            'success'=>'function(data){
                                                $("#subCategories").closest(".item").empty().html(data);
                                                $("#subCategories").selectbox();
                                                console.log(data);
                                            }'
                                            //leave out the data key to pass all form values through
                                            ))); 
                                            //empty since it will be filled by the other dropdown
                                        ?>
                                    </div>
                                    <div class="item">
                                        <label for="model">
                                            Под категория:
                                        </label>
                                        <?=CHtml::dropDownList('subCategories','id', array())?>
                                    </div>

                                    <input type="submit" class="i-submit" value="Найти">
                                </div> 
                            </form>
                        </div>
                        <div class="personal" id="weight">

                            <dl class="desc">
                                <dt>
                                    Индивидуальный подбор
                                </dt>
                                <dd>
                                    Для подбора автозапчастей выберите марку, модель и раздел автомобиля.
                                </dd>
                            </dl>

                            <div class="select">
                                <div class="item">
                                    <label for="mark"> 
                                        Марка:
                                    </label>
                                    <select name="mark">
                                        <option value="0">
                                            Выберите марку
                                        </option>
                                        <option value="1">
                                            BMW
                                        </option>
                                        <option value="2">
                                            Audi
                                        </option>
                                        <option value="3">
                                            Suzuki
                                        </option>
                                    </select>
                                </div>
                            </div>  

                        </div>
                        <div class="personal" id="disc">

                            <dl class="desc">
                                <dt>
                                    Индивидуальный подбор
                                </dt>
                                <dd>
                                    Для подбора автозапчастей выберите марку, модель и раздел автомобиля.
                                </dd>
                            </dl>

                            <div class="select">
                                <div class="item">
                                    <label for="mark"> 
                                        Марка:
                                    </label>
                                    <select name="mark">
                                        <option value="0">
                                            Выберите марку
                                        </option>
                                        <option value="1">
                                            BMW
                                        </option>
                                        <option value="2">
                                            Audi
                                        </option>
                                        <option value="3">
                                            Suzuki
                                        </option>
                                    </select>
                                </div>
                            </div>  

                        </div>
                        <div class="personal" id="book">

                            <dl class="desc">
                                <dt>
                                    Индивидуальный подбор
                                </dt>
                                <dd>
                                    Для подбора автозапчастей выберите марку, модель и раздел автомобиля.
                                </dd>
                            </dl>

                            <div class="select">
                                <div class="item">
                                    <label for="mark"> 
                                        Марка:
                                    </label>
                                    <select name="mark">
                                        <option value="0">
                                            Выберите марку
                                        </option>
                                        <option value="1">
                                            BMW
                                        </option>
                                        <option value="2">
                                            Audi
                                        </option>
                                        <option value="3">
                                            Suzuki
                                        </option>
                                    </select>
                                </div>
                            </div>  

                        </div>
                    </div>
                </div>

                <div class="coll right">
                    <div class="modul first">

                            <p class="phone">+7 (343) 201-36-06</p>
                            <a href="#">
                                Услуги автоэвакуатора
                            </a>
                    </div>
                    <div class="modul second">
                            
                            <p class="question">Есть вопросы?<br>
                                <span>Напиши нам</span>
                            </p>
                            <a href="#">
                                Услуги автоэвакуатора
                            </a>
                    </div>
                </div>  

                <div class="clear"></div>
            </div>
        </div>  