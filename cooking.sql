-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 24, 2019 at 05:46 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.15-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `idCategorie` smallint(6) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`idCategorie`, `nom`) VALUES
(1, 'viande'),
(2, 'légume'),
(3, 'poisson'),
(4, 'fruit');

-- --------------------------------------------------------

--
-- Table structure for table `membres`
--

CREATE TABLE `membres` (
  `idMembre` int(11) NOT NULL,
  `gravatar` varchar(100) NOT NULL,
  `login` varchar(32) NOT NULL,
  `password` varchar(40) NOT NULL,
  `statut` varchar(20) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `dateCrea` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membres`
--

INSERT INTO `membres` (`idMembre`, `gravatar`, `login`, `password`, `statut`, `prenom`, `nom`, `dateCrea`) VALUES
(1, 'natha.png', 'natha', '0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c', 'membre', 'nathalie', 'Martin', '2014-05-06 00:15:57'),
(2, 'sylvie.png', 'syl92', '0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c', 'membre', 'sylvie', 'Dubois', '2014-05-06 00:15:57'),
(3, 'lucie.png', 'luce18', '0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c', 'membre', 'lucie', 'Mantis', '2014-05-06 00:18:13'),
(4, 'laurence.png', 'laulie', '0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c', 'membre', 'laurence', 'Expert', '2014-05-06 00:18:13'),
(5, 'annie.png', 'ann75', '0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c', 'membre', 'annie', 'Frennic', '2014-05-06 00:20:33'),
(6, 'laure.png', 'lolo', '0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c', 'membre', 'laure', 'Astien', '2014-05-06 00:20:33'),
(7, 'didier.png', 'did93', '0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c', 'membre', 'didier', 'Eleg', '2014-05-06 00:22:18'),
(8, 'manu.png', 'man', '0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c', 'membre', 'manu', 'Bientre', '2014-05-06 00:22:18'),
(9, 'michel.png', 'mimiche', '0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c', 'membre', 'michel', 'Maluran', '2014-05-06 00:24:09'),
(10, 'lydia.png', 'lili', '0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c', 'membre', 'lydia', 'Mantour', '2014-05-06 00:24:09');

-- --------------------------------------------------------

--
-- Table structure for table `recettes`
--

CREATE TABLE `recettes` (
  `idRecette` int(11) NOT NULL,
  `titre` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chapo` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preparation` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ingredient` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `membre` int(11) NOT NULL,
  `couleur` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateCrea` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `categorie` int(11) NOT NULL,
  `tempsCuisson` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempsPreparation` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `difficulte` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recettes`
--

INSERT INTO `recettes` (`idRecette`, `titre`, `chapo`, `img`, `preparation`, `ingredient`, `membre`, `couleur`, `dateCrea`, `categorie`, `tempsCuisson`, `tempsPreparation`, `difficulte`, `prix`) VALUES
(2, 'Carottes glacées à  l\'orange', 'Vous ne connaissiez pas le mariage de la carotte et de l\'orange ? Alors permettez-nous de vous donner l\'eau à  la bouche avec cette recette de carottes glacées, acidulées et légèrement sucrées qui donnera du peps à  votre repas du jour !', 'carottes-glacees-orange.jpg', '<ol>\r\n<li>Coupez les carottes en rondelles de 3 mm. Faites sauter les carottes doucement, 2 à 3 minutes dans une sauteuse au beurre.</li>\r\n<li>Déglacez avec un mélange de jus d\'orange et d\'eau. Recouvrez à  ras. Ajoutez le cumin, le sucre, sel et poivre. Laissez mijoter jusqu\'à  absorption du jus et glaçage des rondelles.</li>\r\n<ol>', '<ul>\r\n<li>1 kg de carottes</li>\r\n<li>1½ l d\'eau</li>\r\n<li>2 pincées de sucre</li>\r\n<li>1½ jus d\'orange</li>\r\n<li>1 pincée de cumin</li>\r\n<li>beurre</li>\r\n<li>sel, poivre</li>\r\n</ul>', 1, 'fushia', '2019-04-24 15:26:40', 2, '10 min', '15 min', 'Facile', 'Pas cher'),
(3, 'Penne aux petits légumes', 'Qu\'on se le dise, cette recette convient aux petits comme aux plus grands ! En accompagnant les pâtes de bons légumes nouveaux, de quelques bâtonnets de jambon mais aussi d\'une sauce fondante au parmesan, vous allez créer le coup de coeur !', 'penne-aux-petits-legumes.jpg', '<ol>\r\n<li>\r\nEpluchez les carottes et coupez-les en bâtonnets. Coupez le jambon en bâtonnets également. Ecossez les petits pois.\r\n<li>\r\nPortez 2 l d\'eau salée à  ébullition, ajoutez le bouillon et faites cuire les légumes pendant 10 min. Egouttez-les. Réservez 10 cl d\'eau de cuisson. Salez et faites cuire les pâtes dans le bouillon restant après l\'avoir allongé d\'eau. égouttez bien et mélangez avec les légumes.</li>\r\n<li>\r\nChauffez l\'eau de cuisson réservée. Ajoutez en fouettant le beurre coupé en petits morceaux et le parmesan. Versez cette sauce sur les pâtes. Mélangez et servez.\r\n</li>\r\n<ol>', '<ul>\r\n<li>400 g de pâtes (type pennes)</li>\r\n<li>1 cube de bouillon de volaille</li>\r\n<li>50 g de parmesan râpé</li>\r\n<li>2 carottes</li>\r\n<li>150 g de petits pois nouveaux (des surgelés conviennent aussi)</li>\r\n<li>400 g de jambon</li>\r\n<li>100 g de beurre</li>\r\n<li>sel, poivre</li>\r\n</ul>', 2, 'bleuClair', '2019-04-24 15:30:24', 2, '10 min', '15 min', 'Facile', 'Pas cher'),
(4, 'Risotto de poulet aux carottes', 'Ce risotto est la douceur incarnée. Avec son bon goût de carottes et de navets, il met à  l\'honneur les légumes de printemps ! Ajoutez quelques morceaux de poulet pour un plat complet que vos gourmands vont souvent réclamer !', 'risotto-poulet-carottes.jpg', '<ol>\r\n<li>\r\nCoupez le poulet en petits morceaux et faites-les revenir dans une poêle chauffée et huilée.\r\n</li>\r\n<li>\r\n\r\nPendant ce temps, pelez l\'oignon, puis coupez-le en petits morceaux.\r\n</li>\r\n<li>\r\n\r\nEpluchez les carottes et taillez-les en cubes ainsi que les navets.\r\n</li>\r\n<li>\r\n\r\nIncorporez l\'oignon émincé, les navets et les carottes au poulet doré, puis faites-les sauter pour que les oignons soient transparents.\r\n</li>\r\n<li>\r\n\r\nVersez dans la poêle 1 litre d\'eau pour recouvrir le poulet, réduisez les cubes de bouillons en miettes puis ajoutez-les à  la préparation.\r\n</li>\r\n<li>\r\n\r\nSalez, poivrez, remuez le tout et laissez frémir tout en goûtant le bouillon de volaille de temps en temps.\r\n</li>\r\n<li>\r\n\r\nMettez le riz dans un plat à  gratiner et versez-y ensuite, le bouillon avec les carottes, les navets et les oignons sautés. Ainsi que le poulet.\r\n</li>\r\n<li>\r\n\r\nEnfournez le tout à  th. 7(210Â°C) et laissez cuire le temps indiqué sur l\'emballage du riz.\r\n</li>\r\n<li>\r\n\r\nRemuez régulièrement pour éviter que votre préparation brûle et retirez dés que le riz sera cuit.\r\n</li>\r\n<ol>', '<ul>\r\n<li>300 g de riz</li>\r\n<li>3 filets de poulet</li>\r\n<li>4 carottes nouvelles</li>\r\n<li>2 navets nouveaux</li>\r\n<li>1 oignon</li>\r\n<li>3 cubes de bouillon de volaille</li>\r\n<li>huile</li>\r\n<li>eau</li>\r\n<li>sel, poivre</li>\r\n</ul>', 3, 'vertClair', '2019-04-24 15:32:27', 1, '30 min', '15 min', 'Facile', 'Pas cher'),
(5, 'Pain de viande aux légumes', 'Cette recette de pain de viande est complète ! En plus d\'y trouver de la viande hachée, vous ne pourrez qu\'apprécier les morceaux de carottes et de poivrons qui mettront du soleil dans votre assiette ! C\'est original et c\'est surtout un délice, alors lancez-vous !', 'pain-viande-legume.jpg', '<ol>\r\n<li>\r\nPréchauffez votre four th.6 (180°C).\r\n</li>\r\n<li>\r\n\r\nLavez les carottes et coupez-les en cubes.\r\n</li>\r\n<li>\r\n\r\nLavez et coupez le poivron en cubes.\r\n</li>\r\n<li>\r\n\r\nPelez et émincez finement les oignons et ail.\r\n</li>\r\n<li>\r\n\r\nHachez finement les herbes.\r\n</li>\r\n<li>\r\n\r\nDans une casserole, faites chauffer du beurre et faites revenir les carottes et le poivron.\r\n</li>\r\n<li>\r\n\r\nDans un plat ajoutez la viande hachée et ajoutez les fines herbes.\r\n</li>\r\n<li>\r\n\r\nEgouttez les légumes et incorporez-les à la viande.\r\n</li>\r\n<li>\r\n\r\nMalaxez et faites un petit pain avec la viande.\r\n</li>\r\n<li>\r\n\r\nPlacez le pain dans un plat huile.\r\n</li>\r\n<li>\r\nEnfournez pendant 40 Ã  45 min.\r\n</li>\r\n<li>\r\n\r\nRemuez régulièement pour éviter que votre préparation brûle et retirez dès que le riz sera cuit.\r\n</li>\r\n<ol>', '<ul>\r\n<li>500 g de viande hachée</li>\r\n<li>1 poivron rouge</li>\r\n<li>2 carottes nouvelles</li>\r\n<li>1 oignon</li>\r\n<li>1 oignon nouveau</li>\r\n<li>3 éclats d\'ail</li>\r\n<li>persil, ciboulette, origan, basilic et menthe</li>\r\n<li>poivre</li>\r\n</ul>', 4, 'fushia', '2019-04-24 15:34:18', 1, '45 min', '35 min', 'Facile', 'Pas cher'),
(6, 'Pommes de terre aux herbes', 'Avec les belles journées qui se profilent, on aurait bien envie de se préparer des plats simples et délicieux. Avec une viande grillée, vous devriez essayer ces pommes de terre aux herbes. Légèrement rissolés, elles sont un avant-goût d\'été dans l\'assiette.', 'pommes-de-terre-roquefort.jpg', '<ol>\r\n<li>\r\nFaites chauffer l\'huile dans une sauteuse, mettez y les pommes de terres et l\'ail et faites dorer légèrement.\r\n</li>\r\n<li>\r\n\r\nAjoutez le thym, la marjolaine et le laurier et du sel.\r\n</li>\r\n<li>\r\n\r\nRectifiez éventuellement l\'assaisonnement et servez.\r\n</li>\r\n<ol>', '<ul>\r\n<li>1 kg 500 g de pommes de terre nouvelles</li>\r\n<li>4 gousses d\'ail pilées</li>\r\n<li>2 c. à  soupe de thym et de marjolaine frais et finement hachés</li>\r\n<li>2 feuilles de laurier émiettées</li>\r\n<li>3 c. à  soupe d\'huile d\'olive</li>\r\n<li>sel</li>\r\n</ul>', 5, 'vertClair', '2019-04-24 15:35:49', 2, '30 min', '15 min', 'Facile', 'Pas cher'),
(7, 'Navarin d\'agneau facile', 'Qui dit légumes nouveaux pense immèdiatement au navarin d\'agneau. Ce plat, idéal quelques semaines avant Pâques, rassemblera toute votre petite famille autour d\'un repas gourmand et fondant.  N\'hésitez pas à  préparer votre navarin à  l\'avance, il n\'en sera que meilleur le lendemain !', 'navarin-agneau.jpg', '<ol>\r\n<li>\r\nDécoupez l\'épaule d\'agneau en 6 morceaux et collez-le en 6 tranches. Faites chauffer l\'huile dans une cocotte de grande taille et ajoutez les morceaux de viande deux par deux pour les faire colorer sans laissez-les roussir. Quand ils sont tous dorés, égouttez-les et videz les deux tiers de la graisse fondue.\r\n</li>\r\n<li>\r\n\r\nRemettez-les dans la cocotte et poudrez-les de sucre, mélangez, puis poudrez de farine et faites chauffer en remuant de 2 à  3 minutes pour cuire la farine. Versez le vin et mélangez, salez, poivrez et muscadez. Réglez sur feu modéré.\r\n</li>\r\n<li>\r\n\r\nEbouillantez les tomates, puis pelez-les; épépinez-les et concassez-les.\r\n</li>\r\n<li>\r\n\r\nPelez les gousses d\'ail et hachez-les. Ajoutez ces ingrédients dans la cocotte ainsi que le bouquet garni. Le mouillement doit juste recouvrir la viande: ajoutez éventuellement un peu d\'eau. Lorsque l\'ébullition est atteinte, couvrez et faites mijoter pendant 45 min environ en écumant et en d\'égraissant régulièrement.\r\n</li>\r\n<li>\r\n\r\nPelez les carottes et les navets. Pelez les petits oignons, ôtez les fils des haricots verts, faites chauffer le beurre dans une sauteuse et mettez-y les carottes, les navets et les oignons, puis faites-les revenir en remuant pendant 10 min. Egouttez-les. Faites cuire les haricots verts à  la vapeur pendant 10 min.\r\n</li>\r\n<li>\r\n\r\nAjoutez carottes, navets, oignons et petits pois dans la cocotte. Mélangez et couvrez à  nouveau, poursuivez la cuisson doucement pendant 20 min.\r\n</li>\r\n<li>\r\n\r\nAjoutez enfin les haricots verts 5 min avant de servir et mélangez délicatement. Goûtez pour rectifier l\'assaisonnement. Servez dans la cocotte ou un plat de service creux et bien chaud.\r\n</li>\r\n<ol>', '<ul>\r\n<li>800 g d\'épaule d\'agneau désossée</li>\r\n<li>800 g de collier d\'agneau désossé</li>\r\n<li>1 c. à  café de sucre en poudre</li>\r\n<li>1 c. à  soupe de farine</li>\r\n<li>20 cl de vin blanc sec</li>\r\n<li>noix de muscade</li>\r\n<li>2 tomates mûres</li>\r\n<li>2 gousses d\'ail</li>\r\n<li>1 bouquet garni</li>\r\n<li>300 g de petites carottes nouvelles</li>\r\n<li>100 g de petits oignons blancs</li>\r\n<li>200 g de petits navets nouveaux</li>\r\n<li>300 g de haricots verts</li>\r\n<li>300 g de petits pois écossés</li>\r\n<li>25 g de beurre</li>\r\n<li>2 c. à  soupe d\'huile</li>\r\n<li>sel, poivre</li>\r\n</ul>', 6, 'bleuClair', '2019-04-24 15:39:35', 1, '1h 30 min', '30 min', 'Facile', 'Abordable'),
(8, 'Lotte aux légumes gourmands', 'Les légumes et la viande, c\'est délicieux, mais avec du poisson c\'est encore mieux. Ici, la lotte est légèrement poêlée et accompagnée de légumes croquants pour lesquels vous ne pourrez que succomber ! Equilibrée et gourmande, cette recette est à  tomber !', 'lotte-legumes.jpg', '<ol>\r\n<li>\r\nFaites cuire les navets, les courgettes et les carottes 8 min, dans 1 l d\'eau bouillante salÃ©e puis ajoutez les oignons (partagÃ©s en deux) et les petits pois.\r\n</li>\r\n<li>\r\n\r\nProlongez la cuisson 3 min avant d\'Ã©goutter les lÃ©gumes (en rÃ©servant leur eau de cuisson).\r\n</li>\r\n<li>\r\n\r\nDisposez les dans un plat de cuisson ou vous les mÃªlerez Ã  50 g de beurre, couvrez.\r\n</li>\r\n<li>\r\n\r\nDans du beurre faites lÃ©gÃ¨rement dorer la lotte coupÃ©e en 8 tranches. Assaisonnez puis rÃ©servez le poisson.\r\n</li>\r\n<li>\r\n\r\nDÃ©glacez la poÃªle avec 25 cl de jus de cuisson des lÃ©gumes,portez Ã  Ã©bullition incorporez le reste du beurre.\r\n</li>\r\n<li>\r\n\r\nServez la lotte entourÃ©e de lÃ©gumes et ajoutez quelques tomates sÃ©chÃ©es.\r\n</li>\r\n<li>\r\n\r\nVous pouvez remplacer la lotte par bien d\'autres poissons.\r\n</li>\r\n\r\n<ol>', '<ul>\r\n<li>900 g de lotte</li>\r\n<li>500 g de petits pois à  écosser</li>\r\n<li>8 carottes nouvelles</li>\r\n<li>2 navets nouveaux</li>\r\n<li>250 g de courgettes</li>\r\n<li>4 oignons blancs</li>\r\n<li>3 brins de cerfeuil</li>\r\n<li>quelques tomates séchées</li>\r\n<li>100 g de beurre</li>\r\n<li>sel, poivre</li>\r\n\r\n</ul>', 1, 'fushia', '2019-04-24 15:40:43', 3, '30 min', '40 min', 'Facile', 'Pas cher'),
(9, 'Crème de petits pois frais', 'Si vous n\'aviez pas d\'idée pour le menu de ce soir, le repas est désormais tout trouvé ! Dégustez cette crème de petits pois et vous vous envolerez pour un voyage dans la douceur et la légèreté. Une expérience à  ne pas manquer !', 'creme-petits-poids.jpg', '<ol>\r\n<li>\r\nFaites dissoudre la tablette de bouillon dans 30 cl d\'eau chaude. Fouettez la crème liquide trés froide en chantilly et réservez-la au réfrigirateur.\r\n<li></li>\r\n<li>\r\nEcossez les petits pois. Epluchez et émincez les oignons. Plongez-les dans 2 l d\'eau bouillante avec 2 c. à  soupe de gros sel. Laissez bouillir à découvert pendant 10 min.\r\n</li>\r\n<li>\r\nEntre temps, préparez un saladier et des glaçons.\r\n</li>\r\n<li>\r\nEgouttez rapidement les légumes et plongez-les pendant 5 min dans de l\'eau glacée pour arrêter la cuisson. Egouttez à  nouveau. Passez-les au moulin à  légumes grille fine et recueillez la purée dans une casserole.\r\n</li>\r\n<li>\r\nAjoutez le bouillon, la crème fraîche épaisse et le sucre. Poivrez et portez à ébullition. Ajoutez 3 c. à  soupe de crème chantilly et fouettez quelques secondes.\r\n</li>\r\n<li>\r\nServez aussitôt. Accompagnez d\'un bol de chantilly parsemée de baies roses.\r\n</li>\r\n\r\n<ol>', '<ul>\r\n<li>1 kg de petits pois en cosse ou 400 g de petits pois écossés</li>\r\n<li>1 oignon</li>\r\n<li>1 oignon nouveau</li>\r\n<li>100 g de crème fraîche épaisse</li>\r\n<li>15 cl de crème liquide</li>\r\n<li>1 tablette de bouillon</li>\r\n<li>1 morceau de sucre</li>\r\n<li>1¼ c. à  café de baies roses concassées</li>\r\n<li>gros sel</li>\r\n<li>sel, poivre</li>\r\n\r\n</ul>', 2, 'vertClair', '2019-04-24 15:42:44', 2, '15 min', '30 min', 'Facile', 'Pas cher'),
(10, 'Girolles à  la paysanne', 'Cette recette mêle les saveurs d\'automne avec les girolles fondantes avec les légumes croquants des premiers beaux jours de l\'année. Servez ce mélange gourmand avec de la viande de veau et vous verrez, le bonheur sera complet !', 'girolles-paysanne.jpg', '<ol>\r\n<li>\r\nNettoyez les girolles sans les laver. Laissez-les entières. Pelez les pommes de terre et les carottes.\r\n</li><li>\r\n\r\nLaissez les premiéres entiéres et taillez les secondes en tranches. Faites fondre le beurre dans une cocotte en fonte, placez les tranches de lard et faites-les blondir doucement.\r\n</li><li>\r\n\r\nAjoutez les pommes de terre, les carottes, le thym, le laurier et la gousse d\'ail non pelÃ©e. Faites cuire doucement en remuant de temps en temps, pour que les légumes se colorent légèrement et d\'une maniére uniforme.\r\n</li><li>\r\n\r\nAjoutez les girolles et couvrir. (Les pommes de terre finiront de cuire en absorbant l\'eau rendue par les girolles).\r\n</li><li>\r\n\r\nPoivrez, mais ne pas salez, à  cause du lard. Parsemez le fricot avec le persil et servez directement dans la cocotte.\r\n</li><li>\r\n\r\nServez aussitôt. Accompagnez d\'un bol de chantilly parsemée de baies roses.\r\n</li>\r\n\r\n<ol>', '<ul>\r\n<li>300 g de girolles</li>\r\n<li>2 tranches de poitrine de lard salée</li>\r\n<li>400 g de petites pommes de terre nouvelles</li>\r\n<li>12 petites carottes nouvelles</li>\r\n<li>1 petite gousse d\'ail</li>\r\n<li>1/2 feuille de laurier</li>\r\n<li>1 brindille de thym</li>\r\n<li>1 c. Ã  soupe de persil plat, haché</li>\r\n<li>20 g de beurre</li>\r\n<li>sel, poivre</li>\r\n\r\n</ul>', 3, 'bleuClair', '2019-04-24 15:44:14', 2, '15 min', '40 min', 'Facile', 'Pas cher'),
(11, 'Marmelade de carottes', 'Non, vous ne faites pas erreur, la recette que nous vous proposons ici est bien une marmelade de carottes. Pleine de saveurs et de soleil, cette préparation va éveiller les papilles de vos convives. Essayez-la avec un pâté de campagne, vous nous en direz des nouvelles !', 'marmelade-carottes.jpg', '<ol>\r\n<li>\r\nLavez et pelez les carottes. Faites cuire 1 heure à  l\'eau bouillante. Egouttez et faites passer à  travers un tamis.\r\n</li><li>\r\n\r\nFaites cuire 10 min dans la bassine à  confiture avec le jus de citron, la gousse de vanille et 15 cl d\'eau.\r\n</li><li>\r\n\r\nAjoutez la purée de carottes et laissez cuire encore 30 min à  feu doux en remuant. Incorporez les amandes, mettez en pots et couvrez aussitôt.\r\n</li>\r\n\r\n<ol>', '<ul>\r\n<li>1 kg de carottes nouvelles</li>\r\n<li>1 kg de sucre cristallisé</li>\r\n<li>le jus d\'un citron</li>\r\n<li>1 gousse de vanille</li>\r\n<li>25 g d\'amandes effilées\r\n</li>\r\n\r\n</ul>', 1, 'fushia', '2019-04-24 15:45:20', 2, '1h 40 min', '30 min', 'Facile', 'Pas cher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Indexes for table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`idMembre`);

--
-- Indexes for table `recettes`
--
ALTER TABLE `recettes`
  ADD PRIMARY KEY (`idRecette`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `idCategorie` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `membres`
--
ALTER TABLE `membres`
  MODIFY `idMembre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `recettes`
--
ALTER TABLE `recettes`
  MODIFY `idRecette` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
