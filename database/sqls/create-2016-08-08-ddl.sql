CREATE TABLE IF NOT EXISTS partner (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS currency (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255),
	abbreviation VARCHAR(3)
);

CREATE TABLE IF NOT EXISTS exchange_rate (
	id INT AUTO_INCREMENT PRIMARY KEY,
	id_currency INT,
	rate_start_date DATE,
	rate_end_date DATE,
	rate_value DECIMAL(10,4),
	FOREIGN KEY (id_currency)
		REFERENCES currency(id)
);

CREATE TABLE event (
	id INT AUTO_INCREMENT PRIMARY KEY,
	id_partner INT,
	id_currency INT,
	event_timestamp DATETIME,
	event_value DECIMAL(15,4),
	FOREIGN KEY (id_partner)
		REFERENCES partner(id),
	FOREIGN KEY (id_currency)
		REFERENCES currency(id)
);
