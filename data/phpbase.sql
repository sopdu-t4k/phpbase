-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Мар 04 2019 г., 13:48
-- Версия сервера: 5.6.41
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `phpbase`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `good_id` int(11) NOT NULL,
  `public` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `user`, `message`, `good_id`, `public`) VALUES
(1, 'Игорь', 'Купили то, что хотели. Кофе отличный, с машиной все ок!', 2, b'1'),
(2, 'Сергей', 'Классная кофемашина с возможностью приготовить разнообразный вкусный кофе. Есть возможность программирования кофе и воды на порцию. Довольны ей полностью.', 1, b'1'),
(3, 'Валерий', 'Кофе варит хороший, маленький расход кофе. Есть возможность программирования количества воды для приготовления кофе. Очень тихая, занимает мало места.', 3, b'1'),
(4, 'Алексей', 'Комфортные габариты, приятный дизайн, большой объем бака с водой,Есть прикольные функции:- установка пароля (любимая половинка может выпить очень много) лишает возможности всех кто любит пить без ограничения- установка количества сваренных порций для тех кто хочет контролировать бюджет- регулировка помола (мелкий горчит, большой кислит)- регулировка температуры воды', 4, b'1'),
(6, 'Мари', 'В целом пока довольна. Плюс, что узкая и компактная. По поводу трамбовки многие пишут, что вода не течёт, если сильно трамбовать, либо, если мелкий помол, проходит через дно и засоряется... не знаю, у меня все норм в этом плане. Не скажу, что кофе прям как в кафе получается( пробовала разный) более жидкий что ли.. но я понимаю, что это не профи кофеварка. Капучинатор даёт достаточно рыхлую пену, но опять же, это бюджетный вариант кофеварки, поэтому не жду от неё чудес. Писать, что кофе как в кафе, будет не честно. Поэтому в своём классе считаю хорошая кофеварка.', 3, b'1'),
(7, 'Маргарита', 'Это наша первая кофемашина. На вкус кофе отличный, машина работает шумно,но не критично. Молочная пенка от капучинатора плотная и воздушная. Цена на pleer.ru самая привлекательная. В м-видео уже 31тыс. за такую. В общем вся семья теперь наслаждается кофе по своему вкусу.', 1, b'1'),
(8, 'Сергей', 'Опыт пользования машиной около месяца. Это наша первая кофемашина. Покупкой довольны. Кофе пьём в основном утром. Проснулся, включил машину, поход в туалет, в это время вода нагрелась, включил приготовление кофе, поход в ванную, вышел - кофе готов. Пожалуйте пить кофе. Пишу во всех подробностях что бы представляли что процесс приготовления кофе не отрывает вас от других дел, особенно утром когда надо спешить на работу. Конечно кофе готовится намного быстрее всех этих походов. Время не засекал, но вроде первая большая кружка на 240 гр. минуты через полторы-две, вторая ещё быстрее. Молоко взбивается шумно, но это наверно у всех машин так. Хорошо бы ещё бачок для воды побольше, литра так на три, но это приведёт к увеличению размеров, пусть уж лучше так. Всё удобно устроено, машину двигать не надо. Кофе засыпается сверху, бачок для воды вынимается спереди, ёмкость для слива воды и отработка кофе тоже спереди. Единственное только заварочный узел сбоку расположен, но когда ещё он потребует к себе внимания. В общем мы довольны.', 1, b'1'),
(9, 'Геннадий', 'В целом, кофеварка хорошая. Плюсы: готовит хороший кофе, но надо приноровиться к дозировке, трамбовке, помолу; компактная; нет посторонних запахов от пластика; быстро готова к работе; возможности программирования объема воды, температуры, жесткости воды; понятная инструкция, её надо обязательно прочитать; в комплекте идет средство для очистки; можно поставить высокую кружку; хорошо взбивает паром молоко. Минусы: давление помпы кажется маловатым - чуть не угадаешь с трабовкой, и вместо струек воды идут только капли; резиновый язычок ситечка мешает равномерной трамбовке; расход кофе больше, чем в турке - ну, это не минус, а особенность кофеварок; и надо понимать, что кофеварка - это не кофемашина, капучино утром в кофеварке быстро не сделаешь.', 3, b'0'),
(10, 'Алексей', 'Купили две таких кофемашины. Почему две? Сперва долго выбирали с девушкой из огромного разнообразия кофемашины по характеристикам и ценовому диапазону. Остановились на этой и не прогадали. Кофе варить очень насыщенный, ароматный хотя используем тот же что и заваривали ранее, удобно что можно настроить температуру и количество напитка. Капучино так же получается на уровне как в хороших кафе. Поэксплуатировав кофемашину с неделю решил купить и себе такую же и не жалею об этом.', 5, b'1');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `count`) VALUES
(1, '01.jpg', 11),
(2, '02.jpg', 1),
(4, '09.jpg', 8),
(9, '08.jpg', 6),
(11, '10.jpg', 3),
(13, '03.jpg', 1),
(15, '07.jpg', 1),
(16, '05.jpg', 2),
(17, '06.jpg', 2),
(20, '04.jpg', 2),
(21, '12.jpg', 1),
(22, '13.jpg', 1),
(23, '14.jpg', 2),
(24, '15.jpg', 1),
(25, '11.jpg', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `image` varchar(128) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` tinyint(4) NOT NULL,
  `sale` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `description`, `image`, `price`, `discount`, `sale`) VALUES
(1, 'Кофемашина DeLonghi Magnifica S ECAM 22.110.SB', 'Компактная кофемашина Delonghi Magnifica S ECAM 22.110 — предельно простая в обращении современная автоматическая модель, позволяющая нажатием одной кнопки и поворотом рукоятки готовить различные кофейные напитки. Модель оборудована усовершенствованной кнопочной панелью управления, а поворотный переключатель позволит задать желаемую крепость напитка', '272089m.jpg', '25964.00', 10, b'1'),
(2, 'Кофемашина Philips HD 8649/01', 'Philips HD 8649/01 это автоматическая кофемашина. Вы можете перемолоть новую порцию зерен для каждой чашки, полностью раскрывая их вкус, благодаря керамическим жерновам, которые не перегревают зерна. При помощи ручного капучинатора вы без труда сможете приготовить деликатную молочную пену для вашего кофе. Рассматриваемая модель позволяет приготовить одну или сразу две порции превосходного эспрессо, сваренного из свежемолотых кофейных зерен - достаточно нажать на кнопку и подождать несколько секунд.', '301274m.jpg', '17882.00', 3, b'0'),
(3, 'Кофемашина DeLonghi Dedica EC 685 White', 'Кофе - напиток, который оказывает стимулирующее действие на организм и помогает нам взбодриться. Если ваше утро не обходится без этого вкуснейшего напитка, тогда стоит приобрести DeLonghi EC 685. С этим устройством вы почувствуете себя настоящим баристой, хромированные детали, металлический корпус и профессиональный держатель фильтра будут всячески этому способствовать. Любите капучино? Рассматриваемая модель позволит вам приготовить этот напиток не хуже, чем настоящий профессионал.', '413479m.jpg', '12643.00', 0, b'0'),
(4, 'Кофемашина Saeco Lirika Black', 'Профессиональная кофемашина Saeco Lirika — удачное продолжение знаменитой линейки Royal. Машина претерпела ряд изменений, которые сделали ее более эргономичной, функциональной и удобной для пользования. Она отличается от предыдущей модели более расширенными возможностями. Добавлено максимум настроек для приготовления качественных кофейных напитков. Капучинатор дает возможность готовить напитки с добавлением молока.', '310884m.jpg', '23821.00', 0, b'0'),
(5, 'Кофемашина DeLonghi ECAM 45.764.W', 'Автоматическая кофемашина Delonghi ECAM 45.764 W Eletta Cappuccino Top в элегантном стильном дизайне с новой системой вспенивания молока. Проста в управлении и обслуживании, благодаря сенсорной панели управления с русскоязычным текстовым дисплеем. Приготовит ваш любимый напиток нажатием одной кнопки.', '338355m.jpg', '50261.00', 5, b'1'),
(6, 'Кофемашина Melitta Caffeo Barista TS SST F 760-200', 'Новая кофемашина Caffeo® Barista® -  это отличное сочетание великолепного дизайна и отменного качества работы: кроме классических эспрессо, американо, капучино и латте макиато, данная машина премиум-класса может предложить настоящим ценителям кофе 14 дополнительных запрограммированных вариаций, таким образом, предоставляя необыкновенно широкий ассортимент кофейных напитков. Программирование машины на 4 человек по 4 напитка для каждого.', '437400m.jpg', '69405.00', 0, b'0'),
(7, 'Комбайн Bosch MCM4000 Silver', 'Быстро и качественно обработать необходимые продукты для того или другого блюда разной сложности - это возможность значительно сократить время готовки и радовать близких исключительно  вкусной едой. И для этого каждому стоит приобрести такой кухонный агрегат как комбайн Bosch MCM4000, который поможет Вам все это проделать быстро и качественно. Данный прибор можно смело отнести к одним из самых необходимых на кухне, ведь по производительности и функциональности  ему равных не найти. Для этого изобретения не существует невозможного.', '261096m.jpg', '4933.00', 10, b'0'),
(8, 'Комбайн Zigmund &amp; Shtain De Luxe ZKM-990 Red', 'Кухонная машина Zigmund &amp; Shtain De Luxe ZKM-990 – это многофункциональный прибор, призванный максимально облегчить и вывести на профессиональный уровень приготовление кулинарной выпечки. Особенность представленной модели - Особенность представленной модели - выполняет функции 4 приборов: миксера, мясорубки, паста-мейкера и блендера.\r\n\r\nМашина имеет планетарную систему вращения насадок, которая равномерно взбивает и перемешивает продукт в стационарно стоящей чаше. Такая конструкция используется в оборудовании для профессиональной кухни, поэтому у вас получится приготовить блюда на уровне шеф-повара. ', '628233m.jpg', '11390.00', 5, b'1'),
(9, 'Комбайн Hotpoint-Ariston MC 057C AX0', 'Hotpoint-Ariston MC 057C AX0 – многофункциональная кухонная машина, с помощью которой можно готовить вкусную и разнообразную пищу. Кухонная машина оснащена множеством насадок, позволяющих подготовить ингредиенты, например, измельчить продукты или замесить тесто. Также в комплект входит пароварка, дающая возможность готовить здоровую пищу на пару.  Всеми функциями кухонной машины можно управлять посредством сенсоров, чутко реагирующих на прикосновения. Система управления чрезвычайно удобна, на её освоение не требуется много времени. В комплект входит металлическая чаша объёмом 1,5 литра. В ней удобно измельчать и смешивать различные ингредиенты, замешивать тесто. После использования она легко моется. Разработчики предусмотрели прорезиненные ножки, благодаря которым кухонная машина даже при интенсивном использовании не скользит по столу, а остаётся на одном месте. Владелец может включить машину, установить таймер отключения на срок до 15 часов и уйти по своим делам. Когда сработает таймер, машина отключится автоматически.  ', '527600m.jpg', '24584.00', 12, b'1'),
(10, 'Варочная панель Bosch PKN645B17', 'Встраиваемая электрическая панель Bosch PKN645B17 оснащается двумя конфорками с возможностью расширения зоны нагрева - круглой и овальной. Они идеально подходят для приготовления блюд в крупных кастрюлях, утятницах и других видах посуды.\r\nРабочая поверхность плиты изготовлена из стеклокерамики. Этот материал легко очищается от загрязнений и имеет высокую прочность. Он выдерживает большие нагрузки - в том числе возникающие при падении больших предметов.', '458748m.jpg', '18603.00', 0, b'0'),
(11, 'Варочная панель Darina 4P E323 B', 'Darina 4P E323 B - это простая в использовании электрическая варочная поверхность, функциональная и надёжная кухонная техника.\r\nУстановив на своей кухне эту модель, вы получаете существенную экономию места за счёт компактности и возможности встроить панель в столешницу там, где вам будет удобно. 4 конфорки с разным уровнем мощности способствуют приготовлению правильной пищи, для каждых продуктов в отдельности. Чтобы обезопасить себя, присутствует индикатор остаточного тепла. Установка осуществляется независимо от другой бытовой техники на кухне.', '499810m.jpg', '10295.00', 0, b'0'),
(12, 'Ионизатор Milldom M900 Premium', 'Ионизатор (очиститель) воздуха для детской комнаты от известного производителя высококачественной электроники Milldom. Milldom M900 Premium представляет из себя устройство, которое анализирует воздух внутри детской комнаты на предмет токсичных веществ и пыли. При необходимости включает генератор ионов, очищая воздух вокруг себя.        \r\nПроизводительность модели М900 = 900 мг озона/час и 90 000 ион/см3. Озонаторы других марок вырабатывают всего 150-400 мг озона/час. Почему это так важно? Чем выше производительность прибора, тем он эффективнее и быстрее по времени справляется с задачами (почти в 2 раза быстрее, в сравнении с менее мощными аналогами). Как следствие, вы получаете не только удобство, но и больший срок службы. Все просто - чем меньше прибор находится в работе, тем он дольше служит.', '586207m.jpg', '9594.00', 0, b'0'),
(13, 'Пароварка Braun FS 5100 WH', 'Пароварка Braun FS 5100 WH — современное приспособление, созданное специально для приготовления вкусностей на пару. Готовка пищи с помощью пароварки сохранят ваши силы и время, при этом сбережет в блюде большое количество витаминов и микроэлементов. Прозрачные контейнеры позволяют соблюдать все рекомендации по рецептуре и легко контролировать весь процесс приготовления.  Особенности данной модели: Таймер до 60 минут; Световая индикация работы; Легкое хранение - удобные корзины обеспечивают компактность и экономят место при хранении. Пароваркой Braun FS 5100 WH очень просто управлять, так как на панели есть поворотный переключатель, с помощью которого вы с легкостью сможете настроить работу. ', '384535m.jpg', '5872.00', 0, b'0'),
(14, 'Хлебопечь Redmond RBM-M1911', 'Что может быть прекрасней на завтрак ароматного, свежеиспеченного с хрустящей корочкой хлеба со сладким сливочным маслом? Осуществить эту маленькую радость Вы сможете благодаря Redmond RBM-M1911 . Это устройство пригодится каждой современной хозяйке. С ним Вы сможете баловать свою семью свежим, экологически чистым хлебом каждый день. Вам не придется стоять и замешивать тесто, чтобы что-то испечь, хлебопечка Redmond RBM-M1911 сделает все за вас самостоятельно. С помощью 19 программ автоматического приготовления Вы сможете готовить не только самые разнообразнейшие виды хлебобулочных изделий, но и также супы, десерты, джемы и даже йогурты. Этот прибор также обладает функцией выбора цвета корочки. Устройство можно отнести к самым полезным на кухне. С этой моделью Вы можете вдоволь пофантазировать - добавлять в выпекаемый хлеб различные орехи, сухофрукты и иные наполнители.', '200160m.jpg', '7443.00', 0, b'0');

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `session` varchar(45) NOT NULL,
  `user_name` varchar(128) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `date` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `session`, `user_name`, `phone`, `date`, `status`) VALUES
(1, 'uu3dnrrefqvv4j0d38tj6o4bvtocahef', 'Андрей', '8(495)1246972', '2019-02-20 21:49:13', 4),
(2, 'd7blqph23gd9mp2adon2rrik19rucrn1', 'Василий', '8(800)1236547', '2019-02-21 12:01:32', 5),
(3, '9ii02kirikbl3ldtcqa5rf5mr3l7hqk8', 'Иван', '8(901)7896541', '2019-02-21 14:34:47', 4),
(4, 'r10agrmga730mo2v8rnl11mrce8ah5i4', 'Алекс', '8(916)9751348', '2019-02-21 20:53:24', 2),
(5, '5ek3o364odoto1fubnkkfmcleuavcfl1', 'Виктор', '8(965)3654127', '2019-02-22 12:42:09', 5),
(10, 'av5jja2osg863umjmfpkkvq70krpj29o', 'Августин', '8(658)6482541', '2019-02-27 17:55:01', 3),
(11, 'apfb9sskv7ac5jhnmuuofuc7n5154joc', 'Бармалей', '8(988)7523487', '2019-02-28 14:17:13', 1),
(12, '78m5ojvu9mlmf3rrnsva0qof0amatc8v', 'Алефтина', '8(956)4686287', '2019-02-28 14:18:26', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `order_goods`
--

CREATE TABLE `order_goods` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `good_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_goods`
--

INSERT INTO `order_goods` (`id`, `session`, `good_id`, `quantity`, `discount`) VALUES
(1, 'urpu44topt1qhdgvrbakd5e27gacslek', 1, 1, 0),
(2, 'urpu44topt1qhdgvrbakd5e27gacslek', 3, 3, 0),
(3, 'urpu44topt1qhdgvrbakd5e27gacslek', 6, 1, 0),
(5, 'urpu44topt1qhdgvrbakd5e27gacslek', 2, 2, 0),
(6, 'urpu44topt1qhdgvrbakd5e27gacslek', 4, 1, 0),
(15, 'drhukgbf0gvn2gqifib4h15amlk982vo', 2, 4, 0),
(17, 'drhukgbf0gvn2gqifib4h15amlk982vo', 1, 1, 0),
(19, 'drhukgbf0gvn2gqifib4h15amlk982vo', 5, 2, 0),
(22, 'uu3dnrrefqvv4j0d38tj6o4bvtocahef', 4, 2, 0),
(24, 'd7blqph23gd9mp2adon2rrik19rucrn1', 1, 2, 0),
(25, 'd7blqph23gd9mp2adon2rrik19rucrn1', 5, 2, 0),
(27, '9ii02kirikbl3ldtcqa5rf5mr3l7hqk8', 4, 2, 0),
(28, '9ii02kirikbl3ldtcqa5rf5mr3l7hqk8', 3, 1, 0),
(30, 'r10agrmga730mo2v8rnl11mrce8ah5i4', 2, 1, 0),
(31, 'r10agrmga730mo2v8rnl11mrce8ah5i4', 5, 1, 0),
(32, 'r10agrmga730mo2v8rnl11mrce8ah5i4', 4, 3, 0),
(39, '5fnbi3nhb4e17tdbv8b680hkdedq62np', 1, 1, 0),
(40, '5fnbi3nhb4e17tdbv8b680hkdedq62np', 3, 1, 0),
(42, '5fnbi3nhb4e17tdbv8b680hkdedq62np', 2, 1, 0),
(43, '5fnbi3nhb4e17tdbv8b680hkdedq62np', 6, 1, 0),
(46, '5ek3o364odoto1fubnkkfmcleuavcfl1', 6, 1, 0),
(49, 'letiru3h01egnv0isedsouljatmqnlak', 3, 1, 0),
(50, '3c600icioj7nnmn7ujbaakj6j9lsj3r3', 2, 1, 0),
(52, 'k4jakao8shkhaamrtfog5koae33mpjfp', 12, 1, 0),
(53, 'l3gpn5dfiia8a76k06u68m4npej3kdps', 12, 1, 0),
(54, '7ov6hmo0669hiras5s8jprg90fgqohab', 12, 1, 0),
(55, '0lvsjq5pf89ot9rahc81koi56i1ikqp7', 1, 1, 0),
(56, 'av5jja2osg863umjmfpkkvq70krpj29o', 2, 1, 0),
(66, 'apfb9sskv7ac5jhnmuuofuc7n5154joc', 1, 1, 10),
(67, '78m5ojvu9mlmf3rrnsva0qof0amatc8v', 1, 1, 0),
(68, 'o1n9ou8fc9vii61hk161tl1bl02uab0u', 14, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `status` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_status`
--

INSERT INTO `order_status` (`id`, `status`) VALUES
(1, 'принят'),
(2, 'подтвержден'),
(3, 'отправлен'),
(4, 'доставлен'),
(5, 'отказ');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(128) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `hash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `hash`) VALUES
(1, 'admin', '$2y$10$laEGXmBOZn0I6/UYx6oBH.HAyJG6V2gB/j8DA2NWVqxRThfn3M..m', '20285494425c7ce3e5d50038.28611496');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fr_good_comment_idx` (`good_id`);

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kf_order_order_status_idx` (`status`);

--
-- Индексы таблицы `order_goods`
--
ALTER TABLE `order_goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_goods_good_idx` (`good_id`);

--
-- Индексы таблицы `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `order_goods`
--
ALTER TABLE `order_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT для таблицы `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fr_good_comment` FOREIGN KEY (`good_id`) REFERENCES `goods` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_order_status` FOREIGN KEY (`status`) REFERENCES `order_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `order_goods`
--
ALTER TABLE `order_goods`
  ADD CONSTRAINT `fk_order_goods_good` FOREIGN KEY (`good_id`) REFERENCES `goods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
