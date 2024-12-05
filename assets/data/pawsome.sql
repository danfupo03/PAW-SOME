CREATE TABLE products (
    pid INT PRIMARY KEY,
    name VARCHAR(255),
    description TEXT,
    features TEXT,
    image VARCHAR(255),
    category VARCHAR(50),
    subcategory VARCHAR(50),
    price DECIMAL(10, 2)
);

INSERT INTO Products (pid, name, description, features, image, category, subcategory, price) VALUES
(1, "KONG Plush Teddy Bear Dog Toy", "Soft, durable, and bear toy with a replaceable squeaker for endless fun.", "Soft and cuddly, Durable plush, Replaceable squeaker", "kongBear.png", "Toys", "Stuffed Animals", 7.99),
(2, "Frisco Plush Squeaking Squirrel Dog Toy", "Ultra-soft plush with squeakers to keep your dog engaged during playtime.", "Ultra-soft plush material, Built-in squeakers, Perfect for active play", "friscoSquirrel.png", "Toys", "Stuffed Animals", 6.99),
(3, "Mr Mittens The Cat Plush Cat Toy", "Super soft, with cute details for your cat to have a cuddly friend to play with.", "Soft and plush texture, Perfect for cuddling, Adorable cat-friendly design", "gato.png", "Toys", "Stuffed Animals", 9.99),
(4, "Terry The Platypus Dog Toy", "Australian semi-aquatic mammalian agent Doobie, doobie, Doo-bah! Its Terry the platypus!", "Unique and fun design, Soft plush material, Ideal for imaginative play", "perrybg.png", "Toys", "Stuffed Animals", 8.99),
(5, "Benebone Wishbone Durable Dog Chew Toy", "Real bacon flavor with an ergonomic design for hours of enjoyable chewing.", "Real bacon flavor, Ergonomic wishbone shape, Durable material for aggressive chewers", "benebone.png", "Toys", "Chewables", 12.99),
(6, "Nylabone Power Chew Dog Toy", "Designed for aggressive chewers, flavored with chicken and made for long-lasting play.", "Designed for aggressive chewers, Chicken flavor, Long-lasting durability", "nylabone.png", "Toys", "Chewables", 9.99),
(7, "Little Piece of Pie Chew Dog Toy", "To calm your dog's hunger, designed with a squeaker inside for hours of fun.", "Fun pie-shaped design, Built-in squeaker, Great for interactive play", "pie.png", "Toys", "Chewables", 6.99),
(8, "Rolling Squeaky Chew Dog Toy", "Excellent for heavy duty use for the toughest chewers. Can be rolled for more fun!", "Squeaky and interactive, Heavy-duty material, Rollable for added fun", "sqtoy.png", "Toys", "Chewables", 10.99),
(9, "Pedigree Adult Dry Dog Food", "Complete and balanced nutrition for adult dogs, with real chicken and vegetables.", "Complete and balanced nutrition, Made with real chicken, Enhanced with vegetables", "pedigree.png", "Food", "Dog Food", 19.99),
(10, "Whiskas Adult Dry Cat Food", "Complete and balanced nutrition for adult cats, with real salmon and vegetables.", "Rich in salmon flavor, Balanced nutrition for adult cats, Made with real vegetables", "whiskas.png", "Food", "Cat Food", 14.99),
(11, "Shampoo for Dogs", "Gentle and effective shampoo for dogs, with aloe vera and oatmeal for a shiny coat.", "Contains aloe vera and oatmeal, Gentle on dog's skin, Enhances coat shine", "fleaShampoo.png", "Hygiene", "Shampoo", 8.99),
(12, "Brush for Cats", "Soft bristles for a gentle grooming experience, with a comfortable handle for you.", "Soft bristles for gentle grooming, Ergonomic handle design, Perfect for reducing shedding", "slickerBrush.png", "Hygiene", "Brush", 5.99);
