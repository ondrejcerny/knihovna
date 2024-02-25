SELECT CURDATE() cd, adddate(CURDATE(), interval 30 day) fd;

update vypujceni set  pokuta = case when curdate() > konec then 100 else pokuta end where id=1;

select case when stav = 'vraceno' then '100' else stav end from vypujceni;

select u.id, u.jmeno, u.prijmeni, v.*/*, sum(v.id) pokuta */
from uzivatele u,
     vypujceni v where u.id = v.id_osoba;

select u.id, u.jmeno, u.prijmeni, v.*/*, sum(v.id) pokuta*/
from uzivatele u
     left outer join vypujceni v on u.id = v.id_osoba;

select count(*), sum(v.id) pokuta
from uzivatele u
     left outer join vypujceni v on u.id = v.id_osoba;

select u.id, u.jmeno, u.prijmeni, u.email, case when sum(v.id) is null then 0 else sum(v.id) end pokuty
from uzivatele u
     left outer join vypujceni v on u.id = v.id_osoba
group by u.id, u.jmeno, u.prijmeni, u.email;


select sum(id) from vypujceni;

SELECT pocet FROM katalog WHERE id=2;
 SELECT count(*) FROM vypujceni WHERE id_kniha=2 AND stav='aktivni'; 

SELECT k.pocet - (SELECT count(*) FROM vypujceni v WHERE v.id_kniha=k.id AND v.stav='aktivni') dostupne
FROM katalog k WHERE k.id=2;

