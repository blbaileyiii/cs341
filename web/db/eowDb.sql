--ECHOES OF WHIMSY HEROKU/POSTGRESQL SQL:

CREATE TYPE securityLevel as ENUM('1','2','3');
CREATE TYPE attribType as ENUM('XP','LVL');
CREATE TYPE modType as ENUM('+', 'x');

CREATE TABLE public.user (
	userID BIGSERIAL NOT NULL PRIMARY KEY,	
	userEmail VARCHAR(50) NOT NULL,
	userPass VARCHAR(255) NOT NULL,
	userName VARCHAR(50) NOT NULL,
	userLevel securityLevel NOT NULL DEFAULT '1',
	userDisabled BOOLEAN NOT NULL DEFAULT false,
	userSuspended  BOOLEAN NOT NULL DEFAULT false
);

CREATE TABLE public.txRace (
	txRaceID SERIAL NOT NULL PRIMARY KEY,
	txRaceName VARCHAR(100) NOT NULL,
	txRacePron VARCHAR(30),
	txRaceDesc VARCHAR(150)
);

CREATE TABLE public.txFamily (
	txFamilyID SERIAL NOT NULL PRIMARY KEY,
	txFamilyName VARCHAR(100) NOT NULL,
	txFamilyPron VARCHAR(30),
	txFamilyDesc VARCHAR(150),
	txRaceID INT NOT NULL REFERENCES public.txRace(txRaceID)
);

CREATE TABLE public.txGenus (
	txGenusID SERIAL NOT NULL PRIMARY KEY,
	txGenusName VARCHAR(100) NOT NULL,
	txGenusPron VARCHAR(30),
	txGenusDesc VARCHAR(150),
	txFamilyID INT NOT NULL REFERENCES public.txFamily(txFamilyID)
);

CREATE TABLE public.char (
	charID BIGSERIAL NOT NULL PRIMARY KEY,
	userID BIGINT NOT NULL REFERENCES public.user(userID),
	charName VARCHAR(100) NOT NULL,
	txGenusID INT NOT NULL REFERENCES public.txGenus(txGenusID),
	CONSTRAINT U_charID_userID UNIQUE (charID, userID)
);

CREATE TABLE public.attrib (
	attribID SMALLSERIAL NOT NULL PRIMARY KEY,
	attribName VARCHAR(100) NOT NULL,
	attribTypeOf attribType NOT NULL DEFAULT 'XP'
);

CREATE TABLE public.modifiers (
	modID SMALLSERIAL NOT NULL PRIMARY KEY,
	modName  VARCHAR(100) NOT NULL
);

CREATE TABLE public.skill (
	skillID SERIAL NOT NULL PRIMARY KEY,
	skillName VARCHAR(100) NOT NULL,
	skillDescShort VARCHAR(100) NOT NULL,
	skillDescLong TEXT NOT NULL
);

CREATE TABLE public.item (
	itemID SERIAL NOT NULL PRIMARY KEY,
	itemName VARCHAR(100) NOT NULL,
	skillDescShort VARCHAR(100) NOT NULL,
	skillDescLong TEXT NOT NULL
);

CREATE TABLE public.charAttrib (
	charAttribID BIGSERIAL NOT NULL PRIMARY KEY,
	charID BIGINT NOT NULL REFERENCES public.char(charID),
	attribID SMALLINT NOT NULL REFERENCES public.attrib(attribID),
	charAttribVal BIGINT NOT NULL DEFAULT 0,
	CONSTRAINT U_charID_attribID UNIQUE (charID, attribID)
);

CREATE TABLE public.charSkill (
	charSkillID BIGSERIAL NOT NULL PRIMARY KEY,
	charID BIGINT NOT NULL REFERENCES public.char(charID),
	skillID INT NOT NULL REFERENCES public.skill(skillID),
	charSkillXP BIGINT NOT NULL DEFAULT 0,
	CONSTRAINT U_charID_skillID UNIQUE (charID, skillID)
);

CREATE TABLE public.charInv (
	charInvID BIGSERIAL NOT NULL PRIMARY KEY,
	charID BIGINT NOT NULL REFERENCES public.char(charID),
	itemID INT NOT NULL REFERENCES public.item(itemID),
	charInvSlot INT NOT NULL,
	charInvQty SMALLINT NOT NULL DEFAULT 0,
	charInvDur INT NOT NULL DEFAULT 0,
	CONSTRAINT U_charID_charInvSlot UNIQUE (charID, charInvSlot)
);

CREATE TABLE public.skillEff (
	skillEffID BIGSERIAL NOT NULL PRIMARY KEY,
	skillEffName VARCHAR(100) NOT NULL,
	skillEffDescShort VARCHAR(100) NOT NULL,
	skillEffDescLong TEXT NOT NULL,
	modID SMALLINT NOT NULL REFERENCES public.modifiers(modID),
	modTypeOf modType NOT NULL DEFAULT '+',
	modVal BIGINT NOT NULL DEFAULT 0,
	CONSTRAINT U_skillEffID_modID UNIQUE (skillEffID, modID)
);

CREATE TABLE public.itemEff (
	itemEffID BIGSERIAL NOT NULL PRIMARY KEY,
	itemEffName VARCHAR(100) NOT NULL,
	itemEffDescShort VARCHAR(100) NOT NULL,
	itemEffDescLong TEXT NOT NULL,
	modID SMALLINT NOT NULL REFERENCES public.modifiers(modID),
	modTypeOf modType NOT NULL DEFAULT '+',
	modVal BIGINT NOT NULL DEFAULT 0,
	CONSTRAINT U_itemEffID_modID UNIQUE (itemEffID, modID)
);

INSERT INTO public.txrace (txRaceName, txRacePron, txRaceDesc) VALUES
('Crown', NULL, 'Crown Races'),
('Baku', NULL, 'Companion Races'),
('Val''asur', NULL, 'Sovereign Races'),
('Eidolon', NULL, 'Conceptual Races'),
('Ancillary', NULL, 'Ancillary Races');

INSERT INTO public.txfamily (txFamilyName, txFamilyPron, txFamilyDesc, txRaceID) VALUES
('Anchu', NULL, 'Fish Peoples', 1),
('Aran', NULL, 'Arachnid* Peoples', 1),
('Daemon', NULL, 'Infernal Beings', 4),
('Dokkandru', '(Pron.: Doe-kahn-drew)', 'Guardians/Natural Gods/Spirits', 3),
('Eld''rn', NULL, 'Eldritch/Elder Gods/Great Old Ones', 4),
('El''efren', '(Pron.: L-f-wren) \r\n', 'Elementals', 3),
('Ewos', NULL, 'Celestial Beings', 4),
('Fae', NULL, 'Faerie Peoples / God of Dreams', 5),
('Koda', NULL, 'Mammalian Peoples', 1),
('Langol', NULL, 'Crustacean Peoples', 1),
('N''dulate', NULL, 'Cephalopod Peoples', 1),
('N''garra', NULL, 'Reptilian Peoples', 1),
('Nubu', NULL, 'Avian Peoples', 1),
('N''yani', NULL, 'Amphibian Peoples', 1),
('Yama', NULL, 'Insect Peoples', 1),
('Infermut', NULL, 'Fire Wings', 3),
('Efrit', NULL, 'Efrit/Djinn/Genies', 3);

INSERT INTO public.txgenus (txGenusName, txGenusPron, txGenusDesc, txFamilyID) VALUES
('Anakari', '(Pron.: On-car-ee)', 'Raptors and Scavengers, Vultures, Secretary Bird', 13),
('Oku', '(Pron.: Oh-coo)', 'Owls', 13),
('Fataru', '(Pron.: Faw-tar-oo)', 'Fishers, Puffins, Ibis, Flamingo, and Boobies', 13),
('Burvig', '(Pron.: Burr-vig)', 'Mandarin, Bufflehead, Ducks, Geese, Swans, Pelicans', 13),
('Parro', '(Pron.: Paw-row)', 'Grain, Fruit, and Insect Eaters, Parrots, Toucans, Tits, Woodpeckers, Swallows, Hummingbirds, Jays', 13),
('Tuguai', '(Pron.: Two-gg-why)', 'Turkeys, Chickens, Quail, Pheasant, Roadrunner, Kiwi, Ostrich', 13),
('Garra', '(Pron.: Gar-uh)', 'Lizards', 12),
('Leiflids', '(Pron.: Leaf-lid)', 'Geckos', 12),
('Gemmel', '(Pron.: Gem-ll)', ' Skinks', 12),
('Grokarra', '(Pron.: Grow-car-uh)', ' Crocodiles', 12),
('Tsutsuren', '(Pron.: Sue-Sue-ren)', ' Snakes', 12),
('Tsumari', '(Pron.: Sue-mar-ee)', ' Turtles', 12),
('Lamaan', '(Pron.: La-mon)', ' Salamanders and Newts', 14),
('Chr''upp', '(Pron.: Ch-er-up)', ' Frogs and Toads', 14),
('Baas', '(Pron.: Ba-zz)', ' Blindworms/Caecilians', 14),
('Musteleph', '(Pron.: Moose-tell-F)', ' Badgers,  Weasels, Otters, Ferrets, Red Panda, Martens, Minks, Wolverines, Grison, Pole Cats, Skunks, and Stink Badgers', 9),
('Miyat', '(Pron.: Me-yat)', ' Cats, Ocelots, Lions, Tigers, Panthers, Snow-Leopards, Saber-toothed Cats, Genets', 9),
('Usa', '(Pron.: Oo-suh)', ' Bears, Polar, Spectacle, Grizzlies', 9),
('Kité', '(Pron.: Key-tay)', ' Foxes, Fennec Foxes', 9),
('Rhashang', '(Pron.: Raw-sh-on-gg)', ' Wolves', 9),
('Waraabe', '(Pron.: War-ah-bay)', ' Hyenas', 9),
('Baven', '(Pron.: Baa-vv-en)', ' Rodents, Rats, Mice, Chipmunks, Chinchilla, Squirrel, Beavers', 9),
('Akashi', '(Pron.: Ah-kaw-she)', ' Rabbits', 9),
('Horg', '(Pron.: Whore-gg)', ' Pigs', 9),
('Panangu', '(Pron.: Pan-on-goo)', ' Anteaters, Tamadua, Pangolins', 9),
('Nakoza', '(Pron.: Nn-uh-co-zz-uh)', ' Cervidae, Deer, Antilope, Moose, Caribou, Elk', 9),
('Mogwa', '(Pron.: Maw-gg-ww-aa)', ' Bats', 9),
('Mangrol', '(Pron.: Man-grow-ll)', ' Primates', 9),
('Rh''orc', '(Pron.: Roar-kk)', ' Rhinos, Cows, Horses, Etc', 9),
('Vora Pora', '(Pron.: Vv-or-ah Pp-or-ah)', ' Vespids, Flying Scorpion, Tarantula Hawk, Ants', 15),
('Beleg', '(Pron.: Bell-leg)', ' Beetles, Thorn Bug, Roaches, etc', 15),
('As''tas', '(Pron.: Ah-st-uh-ss)', ' Butterflies and Moths, Hickory Horned Devil (Caterpillars)', 15),
('Rhanea', '(Pron.: Raw-nay-ah)', ' Spiders, Black Widow, Jumping Spider, Bunny Harvestmen', 2),
('Saryx', '(Pron.: Ss-air-ick-ss)', ' Scorpions', 2),
('Nhilim', '(Pron.: Knee-limb)', ' Centipedes, Remipedes', 2),
('Tibur', '(Pron.: Tie-burr)', ' Sharks, Swordfish, Sawfish', 1),
('Thres', '(Pron.: Th-re-ss)', ' Skates, Rays', 1),
('Tsural', '(Pron.: Sue-rawl)', ' Eels', 1),
('Apua', '(Pron.: Ah-poo-ah)', ' Riverfish, Longfish,  Arapaima, Barracuda', 1),
('Nuku', '(Pron.: New-ck-oo)', ' Warfish, Spinyfish, Lionfish, Puffers', 1),
('Paku', '(Pron.: Paw-ck-oo)', ' Roundhead, Tang, Triggerfish, Angelfish, Goldfish, Oscar, Piranha', 1),
('Gili', '(Pron.: Gg-ee-ll-ee)', ' Lobsters, shrimp', 10),
('Krahl', '(Pron.: Crawl)', ' Crabs', 10),
('Niivn', '(Pron.: Niv-en)', ' Lice, Whale lice, Isopods, Giant Isopods, Copepods', 10),
('Ouki', '(Pron.: Ow-key)', ' Octopi', 11),
('Iki', '(Pron.: Ee-key)', ' Squid, Cuttlefish', 11),
('Ahkun', '(Pron.: Ah-coon)', ' Nautilus', 11),
('Volkir', '(Pron.: Vol-ck-ee-rr)', ' Fire Elementals', 6),
('Fré', '(Pron.: Fray)', ' Ice Elementals', 6),
('Likwi', '(Pron.: Leak-we)', ' Water Elementals', 6),
('Blüstraan', '(Pron.: Blue-straw-nn)', ' Wind Elementals', 6),
('Rouk', '(Pron.: Row-ck)', ' Earth Elementals', 6),
('Ismut', '(Pron.: Ee-ss-mut)', ' Dragons - Inner fire', 16),
('Fenke', '(Pron.: Fenn-kk)', ' Fenke: Phoenix - Outer fire\r\n\r', 16),
('Daewos', '(Pron.: Day-woe-ss)', ' Deities - Worship, Reverence', 7),
('Isteni', '(Pron.: I-ss-ten-ee)', ' Angels - Hope', 7),
('Daeva', '(Pron.: Day-vv-uh)', ' Devils - Sin', 3),
('Osore', '(Pron.: Oh-sore-ay)', ' Demons - Fear', 3),
('Xychtnyr', '(Pron.: Zz-ick-tt-near)', ' The Incomprehensible', 5),
('Tchkl''nuv', '(Pron.: Shoe-ck-la-new-vv)', ' Insanity, Madness, Confusion, The Wild', 5);

SELECT txracename, txracedesc, txfamilyname, txfamilydesc, txgenusname, txgenuspron, txgenusdesc
FROM txrace LEFT JOIN txfamily on txrace.txraceid=txfamily.txraceid
LEFT JOIN txgenus ON txfamily.txfamilyid=txgenus.txfamilyid
ORDER BY txracename, txfamilyname, txgenusname;


--SCHEMA CREATION
CREATE SCHEMA cse341ta04
    AUTHORIZATION qmylazbfcihiry;

GRANT ALL ON SCHEMA test TO PUBLIC;

GRANT ALL ON SCHEMA test TO gmybdgutyhhvkc;