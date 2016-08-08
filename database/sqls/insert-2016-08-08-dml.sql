INSERT INTO partner VALUES (1, 'Partner 1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO partner VALUES (2, 'Partner 2', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO partner VALUES (3, 'Partner 3', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO partner VALUES (4, 'Partner 4', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO partner VALUES (5, 'Partner 5', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

-- Rates source: https://www.gov.uk/government/publications/hmrc-exchange-rates-for-2016-monthly
INSERT INTO currency VALUES (1, 'Great Britain Pound', 'GBP', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO currency VALUES (2, 'Euro', 'EUR', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO currency VALUES (3, 'US Dollars', 'USD', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO exchange_rate VALUES (1, 2, '2016-01-01', '2016-01-26', 1.371, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO exchange_rate VALUES (2, 2, '2016-01-27', '2016-01-31', 1.2978, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO exchange_rate VALUES (3, 3, '2016-01-01', '2016-01-26', 1.5003, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO exchange_rate VALUES (4, 3, '2016-01-27', '2016-01-31', 1.4144, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO event (id, event_timestamp, partner_id, event_value, currency_id, created_at, updated_at) VALUES (1, '2016-01-01 10:26:13', 1, 1.7, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO event (id, event_timestamp, partner_id, event_value, currency_id, created_at, updated_at) VALUES (2, '2016-01-01 00:36:21', 1, 0.9, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO event (id, event_timestamp, partner_id, event_value, currency_id, created_at, updated_at) VALUES (3, '2016-01-01 22:13:01', 2, 0.3, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO event (id, event_timestamp, partner_id, event_value, currency_id, created_at, updated_at) VALUES (4, '2016-01-02 13:41:17', 3, 0.8, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO event (id, event_timestamp, partner_id, event_value, currency_id, created_at, updated_at) VALUES (5, '2016-01-02 07:10:09', 4, 0.9, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO event (id, event_timestamp, partner_id, event_value, currency_id, created_at, updated_at) VALUES (6, '2016-01-05 09:59:55', 4, 0.6, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO event (id, event_timestamp, partner_id, event_value, currency_id, created_at, updated_at) VALUES (7, '2016-01-05 12:21:43', 1, 1.3, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO event (id, event_timestamp, partner_id, event_value, currency_id, created_at, updated_at) VALUES (8, '2016-01-07 20:34:38', 2, 0.3, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO event (id, event_timestamp, partner_id, event_value, currency_id, created_at, updated_at) VALUES (9, '2016-01-09 09:07:10', 3, 0.4, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO event (id, event_timestamp, partner_id, event_value, currency_id, created_at, updated_at) VALUES (10,'2016-01-09 07:23:11', 4, 0.4, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO event (id, event_timestamp, partner_id, event_value, currency_id, created_at, updated_at) VALUES (11,'2016-01-09 11:18:33', 1, 0.2, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO event (id, event_timestamp, partner_id, event_value, currency_id, created_at, updated_at) VALUES (12,'2016-01-11 17:44:37', 2, 0.7, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO event (id, event_timestamp, partner_id, event_value, currency_id, created_at, updated_at) VALUES (13,'2016-01-14 16:51:45', 4, 1.4, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO event (id, event_timestamp, partner_id, event_value, currency_id, created_at, updated_at) VALUES (14,'2016-01-15 03:29:59', 3, 2.3, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO event (id, event_timestamp, partner_id, event_value, currency_id, created_at, updated_at) VALUES (15,'2016-01-17 08:51:01', 2, 0.9, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO event (id, event_timestamp, partner_id, event_value, currency_id, created_at, updated_at) VALUES (16,'2016-01-17 18:11:00', 2, 0.7, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO event (id, event_timestamp, partner_id, event_value, currency_id, created_at, updated_at) VALUES (17,'2016-01-17 21:05:38', 1, 0.7, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO event (id, event_timestamp, partner_id, event_value, currency_id, created_at, updated_at) VALUES (18,'2016-01-19 04:47:42', 2, 0.4, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO event (id, event_timestamp, partner_id, event_value, currency_id, created_at, updated_at) VALUES (19,'2016-01-20 05:42:32', 5, 0.5, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO event (id, event_timestamp, partner_id, event_value, currency_id, created_at, updated_at) VALUES (20,'2016-01-20 01:08:58', 2, 1.2, 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
