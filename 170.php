<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'config.php'; // подключение к БД

$target_length = 1700; // длина в миллиметрах

// Получаем все активные товары с длиной 170 см
$stmt = $pdo->prepare("SELECT * FROM NewVanna WHERE active = 1 AND length = ? ORDER BY id");
$stmt->execute([$target_length]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = count($products);

// Разделяем на основные (в наличии и производятся) и снятые/нет в наличии
$mainProducts = array();
$discontinuedProducts = array();
foreach ($products as $p) {
    if ($p['production'] && $p['in_stock']) {
        $mainProducts[] = $p;
    } else {
        $discontinuedProducts[] = $p;
    }
}

// Форматирование цены
function formatPrice($price) {
    return number_format($price, 0, '.', '&nbsp;');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Ванны акриловые 170 см купить в Стерлитамаке — каталог ванн</title>
  <meta name="description" content="В каталоге ванн представлены акриловые гидромассажные ванны с длиной 170 см по выгодным ценам в Стерлитамаке.">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="robots" content="index, follow">
  <meta name="generator" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#2b58cc">
  <link rel="canonical" href="https://str.city/vanny-akrilovye/170">
  <link type="image/x-icon" rel="shortcut icon" href="/favicon.ico">
  <link type="text/css" rel="stylesheet" href="/assets/css/additional.css">
</head>
<body>
<div style="margin-top: -21px;"><?php include "function-index.php";?></div>
<?php if (isset($navigation)) echo $navigation; ?>

<section class="header1 head1 mbr-parallax-background" id="header1-m" style="background-image: url(../../../assets/images/vanna/bg-vanna-akrilovaya-mishel-levaya-170.jpg);">
   <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(37, 46, 127); background-image: url(/assets/images/puzirky.png);">
   </div>
   <div class="container">
      <div class="row justify-content-md-center">
         <div class="mbr-white col-md-12">
            <h1 class="mbr-section-title align-center mbr-bold pt-3 pb-3 mbr-fonts-style display-1" style="font-size: 3.75rem;">Акриловые ванны 170 см в Стерлитамаке</h1>
            <h2 class="mbr-section-subtitle align-center mbr-semibold pb-3 mbr-fonts-style display-2" style="font-size: 1.8rem;">Магазин «СтройСити» — официальный дилер</h2>
            <div class="align-center pb-4">
               <span class="color-die"><a href="#catalog"><img src="/assets/images/vanna/triton.webp" alt="Зарегистрированная торговая марка «Тритон»"></a></span>
            </div>
         </div>
         <div class="mbr-white col-md-10">
            <div class="color-the-die pt-2">
               <h3 class="mbr-section-subtitle align-center mbr-light pb-2 mbr-fonts-style display-2">Купите акриловую ванну Тритон® длиной 170 см и она станет жемчужиной вашей ванной комнаты.</h3>
            </div>
            <div class="mbr-section-btn align-center">
               <a class="btn btn-md btn-primary display-4" href="#catalog"><span class="mbri-arrow-down mbr-iconfont mbr-iconfont-btn"></span>Каталог</a>
            </div>
         </div>
      </div>
   </div>
</section>

<section class="features18 popup-btn-cards catalog1">
    <div class="container">
        <p class="display-7" style="padding-left: 15px;" itemscope itemtype="https://schema.org/BreadcrumbList">
            <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a class="text-black" href="/" itemprop="item">
                    <span itemprop="name">Главная</span>
                    <meta itemprop="position" content="0">
                </a>
            </span> /
            <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a class="text-black" href="/catalog/" itemprop="item">
                    <span itemprop="name">Каталог</span>
                    <meta itemprop="position" content="1">
                </a>
            </span> /
            <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a class="text-black" href="/vanny-akrilovye/" itemprop="item">
                    <span itemprop="name">Ванны акриловые</span>
                    <meta itemprop="position" content="2">
                </a>
            </span> /
            <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <link itemprop="item" href="#" />
                <span itemprop="name">170 см</span>
                <meta itemprop="position" content="3">
            </span> — в наличии <span style="background-color: #ffc425; font-weight: 600; display: inline-block; border-radius: 50%; width: 35px; height: 35px; line-height: 38px; text-align: center; box-shadow: 0 8px 20px rgba(0,0,0,.3);"><?php echo $total; ?></span> позиций
        </p>
        <p class="display-7" style="padding-left: 15px;">Последнее изменение <?php echo date("d.m.Y"); ?> — своевременное обновление информации.<br>Каталог с ценами на акриловые ванны актуален сегодня <?php echo date("d.m.Y"); ?>, в наличии <?php echo count($mainProducts); ?> форм ванн — это <a href="/vanny-akrilovye/pryamougolnye">прямоугольные</a>, асимметричные, <a href="/vanny-akrilovye/uglovye">угловые</a>. Разные стили исполнения — это классические, элегантные, оригинальные, стандартные. Представленные в каталоге ванны выполнены из акрила.</p>
        <h2 class="mbr-section-title pb-3 pt-4 align-center mbr-fonts-style display-2" id="catalog">Ванны акриловые российского производства <span style="background: #ffc425;padding: 8px;border-radius:99px;">в наличии</span></h2>

        <!-- Блок ссылок на фильтры -->
        <div class="media-container-row pt-0 link-blocks">
            <div class="link-block">
                <div class="link-toggler">
                    Длина
                    <div class="link-toggler__arrow"></div>
                </div>
                <div class="link-subblock">
                    <a href="/vanny-akrilovye/140" class="link-block__link">140</a>
                    <a href="/vanny-akrilovye/150" class="link-block__link">150</a>
                    <a href="/vanny-akrilovye/160" class="link-block__link">160</a>
                    <a href="#" class="link-block__link current">170</a>
                    <a href="/vanny-akrilovye/180" class="link-block__link">180</a>
                </div>
            </div>
            <div class="link-block">
                <div class="link-toggler">
                    Форма
                    <div class="link-toggler__arrow"></div>
                </div>
                <div class="link-subblock">
                    <a href="/vanny-akrilovye/pryamougolnye" class="link-block__link">Прямоугольные</a>
                    <a href="/vanny-akrilovye/uglovye" class="link-block__link">Угловые</a>
                </div>
            </div>
        </div>

        <!-- Основные товары -->
        <?php $mainChunks = array_chunk($mainProducts, 4); ?>
        <?php foreach ($mainChunks as $chunk): ?>
        <div class="media-container-row pt-0">
            <?php foreach ($chunk as $item): ?>
            <div class="card p-3 col-12 col-md-6 col-lg-3">
                <div class="card-wrapper">
                    <a href="/vanny-akrilovye<?php echo htmlspecialchars($item['card_url']); ?>#price">
                        <div class="card-img">
                            <div class="mbr-overlay"></div>
                            <div class="mbr-section-btn text-center btn btn-sm btn-success display-7">Подробнее…</div>
                            <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" style="-webkit-user-select: none">
                        </div>
                    </a>
                    <div class="card-box">
                        <h4 class="card-title mbr-fonts-style display-7 text-center"><a class="text-primary" href="/vanny-akrilovye<?php echo htmlspecialchars($item['card_url']); ?>#price"><?php echo htmlspecialchars($item['title']); ?></a></h4>
                        <p class="mbr-text mbr-fonts-style display-7 text-center">
                            Размер: <?php echo $item['length']; ?>×<?php echo $item['width']; ?>×<?php echo $item['height']; ?><br>
                            Артикул: <?php echo $item['article']; ?><br>
                            Цена: <strong><?php echo formatPrice($item['price']); ?> &#8381;</strong>
                        </p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>

        <!-- Блок снятых с производства / нет в наличии -->
        <?php if (count($discontinuedProducts) > 0): ?>
        <div style="font-family: 'Roboto Condensed',sans-serif; font-size: 1.3rem; font-weight: 300; line-height: 1.5;">
            Ванны <a class="spoilers_links" href=""><span style="border-bottom: 1px dotted red;"><span style="color:red">снятые с производства (<?php echo count($discontinuedProducts); ?>)</span></span></a>
            <div class="spoilers_body" style="display: none;">
                <?php $discontinuedChunks = array_chunk($discontinuedProducts, 4); ?>
                <?php foreach ($discontinuedChunks as $chunk): ?>
                <div class="media-container-row pt-0">
                    <?php foreach ($chunk as $item): ?>
                    <div class="card p-3 col-12 col-md-6 col-lg-3">
                        <div class="card-wrapper">
                            <a href="/vanny-akrilovye<?php echo htmlspecialchars($item['card_url']); ?>#price">
                                <div class="card-img">
                                    <div class="mbr-overlay"></div>
                                    <div class="mbr-section-btn text-center btn btn-sm btn-success display-7">Подробнее…</div>
                                    <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" style="-webkit-user-select: none">
                                </div>
                            </a>
                            <div class="card-box">
                                <h4 class="card-title mbr-fonts-style display-7 text-center"><a class="text-primary" href="/vanny-akrilovye<?php echo htmlspecialchars($item['card_url']); ?>#price"><?php echo htmlspecialchars($item['title']); ?></a></h4>
                                <p class="mbr-text mbr-fonts-style display-7 text-center">
                                    Размер: <?php echo $item['length']; ?>×<?php echo $item['width']; ?>×<?php echo $item['height']; ?><br>
                                    Артикул: <?php echo $item['article']; ?><br>
                                    <?php if (!$item['production']): ?>
                                        <span style="color:red">Снято с производства</span><br>
                                    <?php elseif (!$item['in_stock']): ?>
                                        <span style="color:red">Нет в наличии</span><br>
                                    <?php endif; ?>
                                    Цена: <strong><?php echo formatPrice($item['price']); ?> &#8381;</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/vanny-akrilovye/action.php"; ?>

<section class="cont-1" id="content1-o" style="padding-top: 60px;">
    <div class="container">
        <div class="media-container-row">
            <div class="mbr-text col-12 col-md-12 mbr-fonts-style display-6">
                <h2 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-2">Мир ванн и сантехники в Стерлитамаке</h2>
                <div class="mbr-figure" style="width: 100%;">
                    <a href="#catalog"><img src="/assets/images/vanna/catalog/otdel-akrilovyh-vann-v-sterlitamake.jpg" alt="Отдел акриловых ванн в Стерлитамаке" style="-webkit-user-select: none"></a>
                    <div class="img-caption">
                        <p class="display-6">Отдел акриловых ванн в Стерлитамаке</p>
                    </div>
                </div>
                <div class="mbr-figure" style="width: 100%;">
                    <a href="#catalog"><img src="/assets/images/vanna/catalog/gidromassazhnye-akrilovye-vanny-v-sterlitamake.jpg" alt="Гидромассажные акриловые ванны в Стерлитамаке" style="-webkit-user-select: none"></a>
                    <div class="img-caption">
                        <p class="mbr-fonts-style panel-text display-6">Гидромассажные акриловые ванны в Стерлитамаке</p>
                    </div>
                </div>
                <div class="mbr-figure" style="width: 100%;">
                    <a href="#catalog"><img src="/assets/images/vanna/catalog/mir-vann-sterlitamak.jpg" alt="Отдел сантехники и представленные акриловые ванны" style="-webkit-user-select: none"></a>
                    <div class="img-caption">
                        <p class="mbr-fonts-style panel-text display-6">Отдел сантехники и представленные акриловые ванны</p>
                    </div>
                </div>
                <p class="display-4 pt-2">Метраж типовой ванной комнаты предполагает установку ванной длинной 170 см. Купить акриловые емкости различной формы и размеров можно в интернет-магазине &laquo;<a href="/">СтройСити</a>&raquo; в Стерлитамаке. Как официальный представитель компании &laquo;Тритон&raquo;, мы предлагаем самые выгодные условия покупки акриловых ванн 170 см этого производителя.</p>
                <h2 class="pt-3">Преимущества ванны из акрила</h2>
                <ul>
                    <li>Небольшой вес обеспечивает удобство транспортировки и установки сантехники</li>
                    <li>Глянцевая поверхность выглядит эффектно и проста в уходе</li>
                    <li>Из акрила выполняют круглые, овальные, прямоугольные, асимметричные, фигурные ванны</li>
                    <li>Достаточная толщина акрила и дополнительный армирующий слой из полиуретана или стекловолокна в комплексе с эфирными смолами обеспечивают прочность и надежность конструкции</li>
                    <li>Отличная теплоотдача &ndash; вода в акриловой ванне остужается значительно медленнее</li>
                    <li>Антибактериальная поверхность препятствует образованию плесени и грибка</li>
                    <li>Продолжительный срок использования: ванны толщиной более 4 мм прослужат более 10 лет.</li>
                </ul>
                <p>Для установки акриловой ванны потребуется специальный металлический каркас, который обеспечит устойчивость всей конструкции. Чтобы закрыть фронтальную и боковые части, используют экраны под ванну.</p>
                <p>Оформите заказ на сайте или звоните <a href="tel:+73473201102" rel="nofollow">+7(3473)20-11-02</a>. Расскажем об актуальных акциях, условиях доставки и поможем с выбором.</p>
            </div>
        </div>
    </div>
</section>

<?php if (isset($footersite)) echo $footersite; ?>
<?php if (isset($cssjs)) echo $cssjs; ?>
<style>
.color-die {padding: 0.4rem 1.5rem; display: inline-flex; align-items: center; font-weight: 300; background: #ffffff; border-radius: 10px; margin: 0.6rem 0.3rem;}
.color-the-die {padding: 0px 0px 0px 0px; background-color: rgb(43 88 204 / 80%); -webkit-border-radius: 15px; -moz-border-radius: 20px; -ms-border-radius: 20px; -o-border-radius: 20px; border-radius: 0.25rem;}
</style>
<div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i class="mbri-down mbr-iconfont"></i></a></div>
</body>
</html>