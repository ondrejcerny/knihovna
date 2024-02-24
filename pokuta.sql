SELECT CURDATE() cd, adddate(CURDATE(), interval 30 day) fd;

update vyp set ...., pokuta = case when pozde then 100 else pokuta end where ...

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

select u.id, u.jmeno, u.prijmeni, case when sum(v.id) is null then 0 else sum(v.id) end pokuty
from uzivatele u
     left outer join vypujceni v on u.id = v.id_osoba
group by u.id, u.jmeno, u.prijmeni;


select sum(id) from vypujceni;

