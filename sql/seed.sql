insert into ecommerce.products(nome, prezzo, marca)
values ("Tosaerba", 289.99, "Oleomac"),
       ("Vaso", 9.99, "Villeroy e Boch"),
       ("Personal computer", 1799.99, "MSI"),
       ("Bibbia", 15.00, "San paolo"),
       ("Modellino ferrari", 129.99, "Ferrari"),
       ("Iphone 15 Pro Max", 1239.00, "Apple");

insert into ecommerce.roles(nome, descrizione)
values ("shopper", "utente base"),
       ("admin", "utente privilegiato");

insert into ecommerce.users(email, password, role_id)
values ('alice@gmail.com', SHA2('password123', 256), 1),
       ('bob@gmail.com', SHA2('qwerty456', 256), 2),
       ('charlie@outlook.com', SHA2('letmein789', 256), 2),
       ('david@libero.it', SHA2('pass1234', 256), 1);
       
insert into ecommerce.carts(user_id)
values 	(1),
		(2),
		(3),
		(4);