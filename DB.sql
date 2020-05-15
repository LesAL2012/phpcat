-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Май 15 2020 г., 22:34
-- Версия сервера: 5.6.47-cll-lve
-- Версия PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `u31600_resume`
--

-- --------------------------------------------------------

--
-- Структура таблицы `catcategoryanimals`
--

CREATE TABLE `catcategoryanimals` (
  `id` int(2) NOT NULL,
  `category` varchar(64) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `catcategoryanimals`
--

INSERT INTO `catcategoryanimals` (`id`, `category`, `description`) VALUES
(1, 'Longhair', 'Cute pussies'),
(2, 'Semi longhair', 'The most ordinary cat'),
(3, 'Shorthair', 'Six is short and pleasant'),
(4, 'Hairless', 'Unusual - specific');

-- --------------------------------------------------------

--
-- Структура таблицы `catfullinfoanimals`
--

CREATE TABLE `catfullinfoanimals` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `summary` varchar(2048) NOT NULL,
  `article` text NOT NULL,
  `pictures` varchar(500) DEFAULT NULL,
  `categoryid` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `catfullinfoanimals`
--

INSERT INTO `catfullinfoanimals` (`id`, `title`, `summary`, `article`, `pictures`, `categoryid`) VALUES
(2, 'American Longhair', 'The American Longhair is the result of an experiment that went wrong. Breeders were trying to produce an American Shorthair with the shimmering coat and green eyes of a silver shaded Persian: instead, they got the Persian in a shorter coat and leaner body. ', 'The new breed was called the American Longhair. Physical characteristics of an American Longhair depend on its individual ancestry. For example, some cats have a more foreshortened muzzle than others. Overall, the cat has a well-balanced and well-proportioned appearance. Males are generally larger than females. American Longhairs are easy-going pets that inherited an adaptable, friendly, and undemanding nature of Persians. However, they are more active and lively than their placid cousins. People-oriented, they tend to follow the owner from room to room. Highly intelligent, they know how to wrap their humans around their furry paws. They can also learn some tricks (if they feel like, obviously). American Longhairs rarely fight and usually get on well with children and other pets in the household. ', 'amdsherst.jpg', 1),
(3, 'American bobtail', 'The American Bobtail cat is a sturdy medium sized cat with a full and broad chest. It has a noticeable rectangular stance with its hind legs longer than the front legs. The paws are large and round and may have toe tufts. The head is broad and wedge shaped with almond shaped eyes. The head and its characteristics are overall very proportioned. The tail is generally straight but can also be slightly curved and is usually about 2 to 4 inches in length.\r\nThis breed can take up to 3 years to mature fully.', 'Bobtail cats are great sociable companions. They are known to be kind, playful, devoted, friendly, energetic and extremely intelligent. They can have dog-like tendencies and are great with children and will generally adapt easily to new environments. Remeber though that this breed is still being \"developed\", so variations in temperament will occur. Important is to give them opportunities to be playful because they tend to be a quite active breed. American Bobtails come with both short or longhaired coats. Their coat is shaggy and can have any colour fur, with a strong emphasis on the \"wild\" tabby appearance in show animals.', 'ambob.jpg', 1),
(4, 'Balinese cat', 'The Balinese cat has the same body type and physical characteristics as the Siamese cat. There are two types of Balinese cats:\r\n- the extreme Balinese with a svelte and elegant body, wedge-like head, and large ears that continue the triangular shape,\r\n- the traditional Balinese which resembles the traditional Siamese.\r\nThe eyes are almond shaped and vivid blue in both the varieties.\r\nThe only difference between the Siamese and the Balinese is the coat length - Balinese cats are longhair.', 'Extremely active and lively cats ready to play and mess around all day long if allowed.', 'balinese.jpg', 1),
(5, 'British longhair', 'The origin of the British Longhair goes back to around 1870s. The British Longhair cat is also known as the Lowlander in Netherlands and the USA, and as Britanica in Europe. However, this breed is not recognized in the UK as a separate breed.', 'Generally, British Longhair cats have the same physical characteristics as British Shorthair cats, with the only difference in fur length. Thus, British Longhairs have long fur. The further description of Lowlanders resembles the British Shorthair pretty much. They also have a broad chest and a short, muscled back. Their building looks stocky and sturdy. The paws are short with round feet. The tail is thick and either short or average in length. Chubby cheeks make their head look more round; the short, thick and muscled neck complements this overall round look. The chin is well developed and solid. British Longhairs have short, widely set ears. The eyes are large and round, as well as the head. Their colour depends on the colouration. The nose looks short and wide. Males weigh 5 to 10 kg; females weigh up to 5-7 kg.', 'britishd.jpg', 1),
(6, 'Himalayan Cat', 'Having a gorgeous fur of the Persian and a pattern of the Siamese, Himalayan cats are sometimes considered Pointed Pattern (Colorpoint) Persians.', 'Except the coat pattern, Himalayans have nearly the same appearance as the Persian. They are medium to large cats with a short snub nose, muscular legs, a massive round head, and a comparatively short tail. Adult males weigh 9 to 14 pounds; females - 7 to 11 pounds. The face of Himmies can be two types: the Traditional and Extreme. The latter is preferred in cat shows, but the Traditional one is very popular among cat owners, too. Both the types have round blue eyes, full cheeks, a developed chin, and rounded, relatively small ears. The distinctive feature of the Extreme type is, according to its name, an extremely flat face. In many cases, the nose is almost as high as the eyes.', 'gimalamn.jpg', 1),
(7, 'Kurilian Bobtail', 'The Kurilian Bobtail is a medium to large cat originated from the Kuril islands (the Far East of Russia). The main feature of these cats is their unique short tail. The short, bushy tail can be shaped like a whisk, a spiral, or a snag that consists of anywhere between 2-10 vertebrae kinked many times in various directions and with different degrees of articulation. It makes the tail have a tuft form measured either by 3 cm, or between 8 and 15 cm. Never will you find two Kurilians with identical tails, and no other breed has such a variety of tail forms.', 'The body is muscular, well-boned, compact and semi-cobby, with a broad chest. The back legs are slightly longer than the front ones. The head is a large modified wedge with rounded lines. The eyes are walnut shaped, usually yellow or green. White Kurilians may have blue eyes. The triangular ears are medium size, wide at the base, with a slight tilt forward. Adult males weigh up to 15 pounds, females are smaller and weigh 8 to 11 pounds. Overall, the cat looks somewhat wild. Kurilian Bobtails are independent, intelligent, inquisitive, playful, trainable, and very gentle. In spite of their severe look, they have a very well-balanced temperament bereft of aggression. They will gladly sleep in your bed if only you allow them to. Devoted, loving, and sociable. Kurilians usually get on well with other cats, children, dogs and other household pets. Excellent jumpers, they love high spots in the house to better observe their domain. They are also very adaptable and, given enough attention, feel quite comfortable living indoors only. A special feature of this breed is their passion for water. They love to bathe, \"fish\" and play in water.', 'kurbobtail.jpg', 1),
(8, 'Laperm', 'The LaPerm is a medium size cat with a distinctive curly appearance. The head has a triangular form with full whisker pads. The whiskers are curly too. The neck is medium long, well-proportioned to the body. The large ears are slightly flared and continue the triangular shape of the head. The almond-shaped eyes are medium size. The body is athletic and well-boned, moderately long.', 'Affectionate and gentle, LaPerms thrive on attention and interaction. They love their humans and sometimes will want nothing more than a face kiss or cuddling. Even though they are not hyper active, they do want to be involved in everything happening in the house. Basically adaptable. Most enjoy being held or even cradled on their backs. Anyone who wants a unique looking cat with an affectionate and playful personality combined with the skills of a mighty hunter is definitely going to be fascinated by the curly haired LaPerm. The LaPerm can be either longhair or shorthair. Regardless the variety, the coat is springy and airy, stands off the body. The longhairs often have a neck ruff, ringlets, earmuffs, and lynx tipping on the ears. They need weekly grooming, while the shorthairs will be fine with occasional grooming once in several weeks. Any colours and patterns are possible.', 'laperm_c.jpg', 1),
(64, 'Munchkin', 'The muzzle, nose, and thick neck are medium length. The widely set ears are broad at the base and rounded at the tip. The eyes are walnut shaped and widely set, too. The back legs are slightly longer than the front legs. The compact paws should not turn in or out. The tapering tail is moderately thick.', 'Munchkins can climb trees, scratching posts and curtains with the same agility as other cats, but their jumps are lower - the only physical disadvantage of having short legs. It is recommended to keep Munchkins indoors because, along with usual dangers, the breed is rare and thieves still exist in our world.', 'manchkin_c.jpg', 1),
(65, 'Angora cat', 'The Turkish Angora is a medium size cat with a truly graceful appearance. Its elegant body is slender but strong at the same time. The legs are long and muscular. The small paws are round. The tail plumes out like a bottle brush; it is long and tapering towards the tip. The chest is approximately the same width as the hips. The small to medium size head is wedge-shaped. ', 'The nose has a slight break. The muzzle continues the smooth lines of the wedge. The ears are large and alert, pointed and tufted. They are wide at the base and set high on the head, rather close to each other. The almond shaped eyes are slightly slanted. The eye colour does not depend on the coat colour and can be blue, green, gold-green, amber, and odd-eyed (one blue eye and one green, green-gold or amber eye). The eye colour can change with age. Overall, the cat has a very well-balanced and well-proportioned appearance.\r\nAdult males weigh 7 to 10 pounds, adult females weigh 5 to 8 pounds.', 'angorskaya.jpg', 2),
(82, 'Neva Masquerade', 'Neva Masquerade – a mysterious name for a mysterious thing of beauty! The Neva Masquerade is the point variation on the Siberian cat and shares many characteristics with this breed.', 'Apart from its colouration, the Neva Masquerade does not differ from the Siberian cat. As the point variation on the breed, these medium-sized cats weigh up to 9kg. They are late developers and are only fully grown once they reach three years in age. Their semi-long fur is made up of water-resistant, robust top hair and a fluffy undercoat. The thick crown around the head and neck proves particularly eye-catching! In summer, the Neva Masquerade loses the thick undercoat that keeps it warm during the Siberian winter, with the summer coat proving much shorter and less abundant. However, tufts of hair on the ears and between the toes should still remain in place during the warm summer months. Like the Siberian cat, the Neva Masquerade has a round head with a curved forehead, big eyes and wide, medium-sized ears. Eye colour should be uniform and matching the fur colour. Bright blue is very popular for the Neva Masquerade.', 'nev_mask.jpg', 1),
(88, 'Abyssinian cat', 'The Abyssinian is a slender, fine-boned, medium-sized cat. The head is moderately wedge shaped, with a slight break at the muzzle, and nose and chin ideally forming a straight vertical line when viewed in profile. They have alert, relatively large pointed ears. The eyes are almond shaped and are gold, green, hazel or copper depending on coat color. The legs tend to be long in proportion to a graceful body, with small oval paws; the tail is likewise long and tapering.', 'Abyssinian kittens are born with dark coats that gradually lighten as they mature, usually over several months. The adult coat should not be excessively short and is ideally fine, dense and close-lying, silky to the touch. The ticked or agouti effect that is the trademark of the breed—genetically a variant of the tabby pattern—should be uniform over the body, although the ridge of the spine and tail, back of the hind legs and the pads of the paws are always noticeably darker. Each hair has a light base with three or four bands of additional color growing darker towards the tip. The base colour should be as clear as possible; any extensive intermingling with grey is considered a serious fault. A tendency to white on the chin is common but likewise must be minimal. The typical tabby M-shaped marking is often found on the forehead.', 'abysyn.jpg', 3),
(89, 'Australian smoky cat', 'Australian smoky cat is a unique, unique animal, like all other animals, whose homeland is Australia. At the moment, the Australian mister is officially recognized only by WCF, which, incidentally, is not surprising.', 'Outside Australia, the Australian smoky cat is rare. The Australian Myst is a relatively new breed, created in Sydney in 1975-1976. The progenitors of this breed include Abyssinian and Burmez, as well as domestic non-generic cats. When creating the Australian smoky cat used a special breeding program, which allowed to take from each breed the best. Before the breeders, the task was to get a kosh resembling the Burmese, and having a color with a characteristic spotted pattern. \r\nAs a result, the Australian smoky cat took from Burmese her physique and sociability, and also took four of the six colors from the color palette. From the abyssin, the Australian mister adopted two shades of color and ticking, as well as their unparalleled activity and cheerfulness. Inbreeding domestic cats introduced the Australian smoky cat early maturation and an unusually beautiful mottled pattern. So, having achieved the set goal, in 1986 the created breed was registered as spotted myst by Australian amateur organizations.', 'avstm.jpg', 3),
(90, 'Bombay cat', 'The Bombay is an easy-going, yet energetic cat. She does well in quiet apartments where she’s the center of attention as well as in lively homes with children and other pets. She’ll talk to you in a distinct voice, and you’re likely to find her in the warmest spot in your home, whether that’s in the sunlight from a window or curled up under the covers in bed with you. Bombays are smart and learn tricks quickly, so keep them entertained by teaching them new tricks and providing them interactive toys to play with.', 'Bombays have a dramatic and deep black coat. The black coat is dominant, but occasionally a litter produces a sable-colored kitten, and some associations permit these kittens to be registered as Burmese. Bombay eye color ranges from gold to copper.\r\nOne genetic disease Bombay cats carry a risk for is a craniofacial defect sometimes seen in newborn kittens. Responsible breeders do their best to avoid breeding cats who carry the gene for this fatal defect, however. Bombays may also be more prone to hypertrophic cardiomyopathy, excessive tearing of the eyes and respiratory issues due to their flat facial structure.', 'bombaycat.jpg', 3),
(91, 'American Wirehair', 'The American Wirehair is a medium-size cat with regular features and a sweet expression. ', 'This cat’s coat may be wired, but his personality is not. The American Wirehair tends to be a calm and tolerant cat who takes life as it comes. His favorite hobby is bird-watching from a sunny windowsill, and his hunting ability will stand you in good stead if insects enter the house.\r\n\r\nIf the American Wirehair is well socialized as a kitten, he should be happy to meet and interact with your guests. This six to 11-pound cat can be a good choice for families with older children who will treat him respectfully, but younger children and toddlers should be supervised so they don’t manhandle him. He is also perfectly capable of getting along with cat-friendly dogs in the household.', 'amhh.jpg', 3),
(92, 'British cat', 'The British Shorthair is the pedigreed version of the traditional British domestic cat, with a distinctively stocky body, dense coat, and broad face. The most familiar color variant is the \"British Blue,\" a solid grey-blue coat, copper eyes, and a medium-sized tail. The breed has also been developed in a wide range of other colours and patterns, including tabby and colorpoint.', 'It is thought that the invading Romans initially brought Egyptian domestic cats to Great Britain. These cats then interbred with the local European wildcat population. Over the centuries, their naturally isolated descendants developed into distinctively large, robust cats with a short but very thick coat, to better withstand conditions on their native islands. ', 'british_sh.jpg', 3),
(95, 'European Shorthair Cat', 'The term has also been used as an elaborate way of referring to common domestic cats of Europe, causing some confusion as the pedigree cats of this breed also should resemble the typical domestic cats of Europe. In WCF a similar breed is known as Celtic Shorthair and was at a time considered the same breed, but this breed has some difference from the Europeans, and the WCF now register true Europeans under this breed name instead of under Celtic Shorthair.', 'The head is rounded and should be longer than it is wide, making it not as round as the head of the British Shorthair. The ears are medium-sized; the width of the ear corresponds to the height of the ears, which has a slightly rounded tip. They are quite wide-set and upright. The eyes are rounded and may be of any colour.', '20031700european.jpg', 3),
(96, 'Burmese cat', 'Most modern Burmese are descendants of one female cat called Wong Mau, which was brought from Burma to America in 1930 and bred with American Siamese. From there, American and British breeders developed distinctly different Burmese breed standards, which is unusual among pedigreed domestic cats. Most modern cat registries do not formally recognize the two as separate breeds, but those that do refer to the British type as the European Burmese.', 'In 1871, Harrison Weir organised a cat show at the Crystal Palace. A pair of Siamese cats were on display that closely resembled modern American Burmese cats in build, thus probably similar to the modern Tonkinese breed. The first attempt to deliberately develop the Burmese in the late 19th century in Britain resulted in what were known as Chocolate Siamese rather than a breed in their own right; this view persisted for many years, encouraging crossbreeding between Burmese and Siamese in an attempt to more closely conform to the Siamese build. The breed thus slowly died out in Britain. Meanwhile, in the UK, interest in the breed was reviving.', 'birman.jpg', 2),
(97, 'Norwegian Forest Cat', 'It is a big, strong cat, similar to the Maine Coon breed, with long legs, a bushy tail and a sturdy body. The breed is very good at climbing, since they have strong claws. The lifespan is usually 14 to 16 years, though kidney and heart diseases have been reported in the breed. Specifically in this breed, complex rearrangements of glycogen branching enzyme (GBE1) can cause a perinatal hypoglycaemic collapse and a late-juvenile-onset neuromuscular degeneration in glycogen storage disease type IV.', 'It is both independent and an affectionate member of the family that loves attention but does not demand it. It is suited to being a playful, indoor cat. A bit more independent than a lap cat, you can still expect a Norwegian forest cat to share a loving purr and the press of its head against your hand. Although, this may be one of the few times you will hear from your wegie, as they do not vocalize as often as other cats.\r\nA natural breed, wegies are long-haired, have inverted triangular heads, and almond-shaped eyes. They are bigger than most house cats; males grow significantly larger than females. While the Norwegian forest cat sports a double coat that offers excellent protection in the winter, it is believed the breed may have obtained its distinctive double coat of long fur by mating with regional cats.\r\n\r\nThe Norwegian forest cat drew some attention in 1938 when it was exhibited at a cat show. The Norwegian Forest Cat Club was formed to help preserve the breed. Unfortunately, World War II interrupted its ascent to fame. The breed almost went extinct during the war due to crossbreeding. However, the Norwegian Forest Cat Club continued to work hard to save the breed. In 1977, the breed was registered with Europe’s Federation Internationale Feline, and a few years later, wegies began showing up in the United States.', 'nor_les.jpg', 2),
(98, 'Dwelf', 'The Dwelf is an interesting looking and hairless cat breed that is quite new. In fact, its name is a combination of its elf-like features and dwarf-like stature. To develop this small kitty, the Munchkin, the American Curl, and the Sphynx were crossed, but the Sphynx’s features are the most apparent.', '<p>This is considered a designer cat breed, as it was developed by combining breeds that have multiple mutations. Therefore, there is quite a bit of controversy that surrounds it, with some experts claiming it is unethical to breed these cats. They could develop skeletal problems, so choosing the right breeder is important to ensure your pet will be as healthy as possible.</p>\n\n<p><strong>Dwelf cats</strong> make wonderful feline companions. They are described as being highly social and interactive, and their personality can even be described as being dog-like. As a result, these cats are a great choice for families who have plenty of time to devote to their furry friends. These kitties prefer being around people, so they should be included in family activities and they shouldn&rsquo;t be left alone. And these playful cats are also a lot of fun to watch, so giving your pet a variety of toys will help him release his energy and keep you entertained. Plus, Dwelf cats are intelligent, so they do require mental stimulation as well.</p>\n', 'dvelf.jpg', 4),
(99, 'Canadian Sphynx', 'he Sphynx cat is a breed of cat known for its lack of coat (fur). Hairlessness in cats is a naturally occurring genetic mutation; however, the Sphynx cat, as a breed, was developed through selective breeding, starting in the 1960s.', '<p>Although hairless cats have been reported throughout history, breeders in Europe have been working on the Sphynx breed since the early 1960s. Two different sets of hairless felines discovered in North America in the 1970s provided the foundation cats for what was shaped into the existing Sphynx breed.</p>\n\n<p><strong>Sphynx cats</strong> can also have more ear wax than most hairy domestic cats because they have little to no hair in their ears. Dirt, skin oils (sebum), and ear wax accumulates in the ears, and needs to be cleaned out on a weekly basis, usually before bath time.</p>\n', 'kan_sfinks.jpg', 4),
(100, 'Siberian cat', 'The Siberian is a centuries-old landrace (natural variety) of domestic cat in Russia and recently developed as a formal breed with standards promulgated the world over since the late 1980s.', '<p><strong>Siberians</strong> vary from medium to large in size.<img alt=\"\" src=\"https://besthqwallpapers.com/Uploads/21-2-2018/41752/siberian-cat-big-fluffy-cat-pets-cats-breeds-of-cats.jpg\" style=\"float:right; height:156px; margin:0px 5px; width:250px\" /> The formal name of the breed is Siberian Forest Cat, but usually it&rsquo;s simply called the Siberian or Siberian cat. Another formal breed name is the Moscow Semi-Longhair. The cat is an ancient breed that is now believed to be ancestral to all modern long-haired cats. The cat has similarities with the Norwegian forest cat, to which it is likely closely related. It is a natural breed from Siberia and the national cat of Russia. While it began as a landrace, it is selectively bred and pedigreed today in at least seven major cat fancier and breeder organizations.</p>\n\n<p>The <img alt=\"\" src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRbBsmawWZK3fp1Q-MhRSNpJidJwC72vEpNMVLlbHZPOvMzzU9z&amp;usqp=CAU\" style=\"float:left; height:161px; margin-left:5px; margin-right:5px; width:250px\" />colorpoint variant of the breed is called the Neva Masquerade by some registries, including F&eacute;d&eacute;ration Internationale F&eacute;line (FIF&eacute;). Known to be an exceptionally agile jumper, the Siberian is a strong and powerfully built cat, with strong hindquarters and large, well rounded paws and an equally large full tail. They have barrelled chests and medium/large sized ears, large eyes, broad foreheads, and stockier builds than other cats. Their large round eyes give an overall sweet expression to their face. Siberians have a slight arch to their back, because their hind legs are a bit longer than the front legs. This shape contributes to their incredible agility and athleticism. A not-for-profit association of breeders, (Siberian Research Inc), was founded in 2005 to study allergen levels and genetic diseases in the Siberian breed.</p>\n\n<p>As <img alt=\"\" src=\"https://brit-petfood.com/file/nodes/product/Sibi%CB%9Dsk%E2%80%A0.JPG\" style=\"float:right; height:167px; margin-left:5px; margin-right:5px; width:250px\" />of March 2010, fur and saliva samples from over 300 Siberians have been submitted for analysis, many directly from a veterinarian. Salivary Fel d1 allergen levels in Siberians ranged from 0.08-27 &micro;g per ml of saliva, while fur levels ranged from 5-1300 &micro;g. The high-end of these ranges is consistent with results from prior studies, though the low end is below expected results.</p>\n', 'sib_cat.jpg', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `cattaganimals`
--

CREATE TABLE `cattaganimals` (
  `id` int(11) NOT NULL,
  `tag` varchar(128) NOT NULL,
  `publicid` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `cattaganimals`
--

INSERT INTO `cattaganimals` (`id`, `tag`, `publicid`) VALUES
(182, 'requires care', 2),
(183, 'weight 3.5-6 kg', 2),
(184, 'average activity', 2),
(203, 'requires care', 5),
(204, 'weight 3.5-6 kg', 5),
(205, 'low activity', 5),
(206, 'requires care', 6),
(207, 'weight 4-6 kg', 6),
(208, 'low activity', 6),
(212, 'no maintenance', 7),
(213, 'weight 2-5 kg', 7),
(214, 'average activity', 7),
(215, 'no maintenance', 8),
(216, 'weight 2-5 kg', 8),
(217, 'high activity', 8),
(227, 'requires care', 3),
(228, 'weight 3.5-6 kg', 3),
(229, 'low activity', 3),
(230, 'requires care', 4),
(231, 'weight 3.5-6 kg', 4),
(232, 'average activity', 4),
(233, 'no maintenance', 64),
(234, 'weight 2-5 kg', 64),
(235, 'average activity', 64),
(242, 'no maintenance', 65),
(243, 'weight 3.5-6 kg', 65),
(244, 'high activity', 65),
(245, 'requires care', 82),
(246, 'weight 3-7 kg', 82),
(247, 'average activity', 82),
(248, 'no maintenance', 88),
(249, 'high activity', 88),
(250, 'weight 3.5-6 kg', 88),
(251, 'no maintenance', 89),
(252, 'average activity', 89),
(253, 'weight 3.5-6 kg', 89),
(254, 'no maintenance', 90),
(255, 'weight 3-7 kg', 90),
(256, 'high activity', 90),
(260, 'weight 3.5-6 kg', 91),
(261, 'no maintenance', 91),
(262, 'high activity', 91),
(266, 'no maintenance', 92),
(267, 'weight 2-8 kg', 92),
(268, 'average activity', 92),
(272, 'weight 2-8 kg', 95),
(273, 'no maintenance', 95),
(274, 'average activity', 95),
(281, 'requires care', 96),
(282, 'weight 4-6 kg', 96),
(283, 'average activity', 96),
(293, 'requires care', 97),
(294, 'weight 3-7 kg', 97),
(295, 'average activity', 97),
(396, 'average activity', 99),
(397, 'no maintenance', 99),
(398, 'weight 2-5 kg', 99),
(399, 'high activity', 98),
(400, 'no maintenance', 98),
(401, 'weight 2-5 kg', 98),
(411, 'average activity', 100),
(412, 'requires care', 100),
(413, 'weight 3-7 kg', 100);

-- --------------------------------------------------------

--
-- Структура таблицы `cattasks`
--

CREATE TABLE `cattasks` (
  `id` int(11) NOT NULL,
  `task` text NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `editadmin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cattasks`
--

INSERT INTO `cattasks` (`id`, `task`, `username`, `email`, `status`, `editadmin`) VALUES
(1, 'Get a pet cat.', 'Alex', 'al20@mail.com', 1, NULL),
(2, 'Take the cat for a walk in the park.', 'Ivan', 'ivan@iv.net', NULL, NULL),
(3, 'Take part in a regional cat show.', 'Nick', 'Nick@nk.com', NULL, 1),
(4, 'Set a claw comb for claws.', 'Georg', 'igor@ig.net', NULL, NULL),
(5, 'Comb out the coat.', 'Stas', 'stas@com.ua', 1, NULL),
(6, '<h3>Make an appointment with the veterinarian.</h3>\r\n\r\n<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:200px; margin:0 auto;\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"background-color:gray; text-align:center\"><span style=\"color:#ffffff\">1</span></td>\r\n			<td style=\"background-color:gray; text-align:center\"><span style=\"color:#ffffff\">2</span></td>\r\n			<td style=\"background-color:gray; text-align:center\"><span style=\"color:#ffffff\">3</span></td>\r\n			<td style=\"background-color:gray; text-align:center\"><span style=\"color:#ffffff\">4</span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:blue; text-align:center\"><span style=\"color:#ffffff\"><strong>A</strong></span></td>\r\n			<td style=\"text-align:center\">10-00</td>\r\n			<td style=\"text-align:center\">15-00</td>\r\n			<td style=\"background-color:red; text-align:center\">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:blue; text-align:center\"><span style=\"color:#ffffff\"><strong>B</strong></span></td>\r\n			<td style=\"background-color:yellow; text-align:center\">12-00</td>\r\n			<td style=\"background-color:green; text-align:center\"><strong><span style=\"color:#ffffff\">A2</span></strong></td>\r\n			<td style=\"background-color:green; text-align:center\"><strong><span style=\"color:#ffffff\">B34</span></strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:blue; text-align:center\"><span style=\"color:#ffffff\"><strong>C</strong></span></td>\r\n			<td style=\"text-align:center\">17-00</td>\r\n			<td style=\"background-color:red; text-align:center\">&nbsp;</td>\r\n			<td style=\"text-align:center\">14-30</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>', 'test', 'test@test.com', NULL, 1),
(7, '<p><strong>Cook</strong> fish and oatmeal.</p>', 'Fedir', 'fedor@com.ua', NULL, 1),
(8, '    Change the toilet for the cat.', 'David', 'David@nk', NULL, NULL),
(9, '<p><em><strong>Buy for cats:</strong></em></p>\r\n\r\n<ul>\r\n	<li>&nbsp;milk;</li>\r\n	<li>&nbsp;meat;</li>\r\n	<li>&nbsp;fish.</li>\r\n</ul>', 'Gevork', 'jorik@j.ar', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `catuser`
--

CREATE TABLE `catuser` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `catuser`
--

INSERT INTO `catuser` (`id`, `login`, `password`, `email`, `name`, `role`) VALUES
(7, 'CatAdmin', '$2y$10$g0Juicy2qMVoMBH1AMz6Xu74YYJykRmrMiriL78ylyKtwcTUn.0g2', 'CatAdmin@cat.ua', 'Cat A', 'admin'),
(8, 'CatUser', '$2y$10$9aDIfhusG2p1gc.aCRizS.ao267FDTVP3Gac.m7DPkvCbGYmY1Vye', 'CatUser@cat.ua', 'Cat U', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `catcategoryanimals`
--
ALTER TABLE `catcategoryanimals`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `catfullinfoanimals`
--
ALTER TABLE `catfullinfoanimals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`categoryid`);

--
-- Индексы таблицы `cattaganimals`
--
ALTER TABLE `cattaganimals`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cattasks`
--
ALTER TABLE `cattasks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `catuser`
--
ALTER TABLE `catuser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `catcategoryanimals`
--
ALTER TABLE `catcategoryanimals`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `catfullinfoanimals`
--
ALTER TABLE `catfullinfoanimals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT для таблицы `cattaganimals`
--
ALTER TABLE `cattaganimals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=414;

--
-- AUTO_INCREMENT для таблицы `cattasks`
--
ALTER TABLE `cattasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `catuser`
--
ALTER TABLE `catuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `catfullinfoanimals`
--
ALTER TABLE `catfullinfoanimals`
  ADD CONSTRAINT `catfullinfoanimals_ibfk_1` FOREIGN KEY (`categoryid`) REFERENCES `catcategoryanimals` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
