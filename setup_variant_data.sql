-- Setup script for product variants, colors, and sizes
-- Run this in your database if artisan commands are not working

-- Insert sample colors
INSERT IGNORE INTO product_colors (id, name, hex_code, sort_order, status, created_at, updated_at) VALUES
(1, 'Black', '#000000', 1, 1, NOW(), NOW()),
(2, 'White', '#FFFFFF', 2, 1, NOW(), NOW()),
(3, 'Red', '#FF0000', 3, 1, NOW(), NOW()),
(4, 'Blue', '#0000FF', 4, 1, NOW(), NOW()),
(5, 'Green', '#008000', 5, 1, NOW(), NOW()),
(6, 'Yellow', '#FFFF00', 6, 1, NOW(), NOW()),
(7, 'Purple', '#800080', 7, 1, NOW(), NOW()),
(8, 'Orange', '#FFA500', 8, 1, NOW(), NOW()),
(9, 'Pink', '#FFC0CB', 9, 1, NOW(), NOW()),
(10, 'Gray', '#808080', 10, 1, NOW(), NOW());

-- Insert sample sizes
INSERT IGNORE INTO product_sizes (id, name, display_name, sort_order, status, created_at, updated_at) VALUES
(1, 'XS', 'Extra Small', 1, 1, NOW(), NOW()),
(2, 'S', 'Small', 2, 1, NOW(), NOW()),
(3, 'M', 'Medium', 3, 1, NOW(), NOW()),
(4, 'L', 'Large', 4, 1, NOW(), NOW()),
(5, 'XL', 'Extra Large', 5, 1, NOW(), NOW()),
(6, 'XXL', 'Double Extra Large', 6, 1, NOW(), NOW()),
(7, '3XL', 'Triple Extra Large', 7, 1, NOW(), NOW());

-- Assign colors to first product (assuming product ID 1 exists)
-- Replace product_id = 1 with your actual product ID
INSERT IGNORE INTO product_color_assignments (product_id, color_id, created_at, updated_at) VALUES
(1, 1, NOW(), NOW()), -- Black
(1, 2, NOW(), NOW()), -- White  
(1, 3, NOW(), NOW()), -- Red
(1, 4, NOW(), NOW()); -- Blue

-- Assign sizes to first product (if using sizes)
INSERT IGNORE INTO product_size_assignments (product_id, size_id, created_at, updated_at) VALUES
(1, 2, NOW(), NOW()), -- S
(1, 3, NOW(), NOW()), -- M
(1, 4, NOW(), NOW()), -- L
(1, 5, NOW(), NOW()); -- XL

-- Create product variants for color-only variants (no sizes)
-- These create variants with different colors but no size requirement
INSERT IGNORE INTO product_variants (product_id, size_id, color_id, stock, price_adjustment, status, created_at, updated_at) VALUES
(1, NULL, 1, 10, 0.00, 1, NOW(), NOW()),    -- Black variant
(1, NULL, 2, 15, 5.00, 1, NOW(), NOW()),    -- White variant (+$5)
(1, NULL, 3, 8, 10.00, 1, NOW(), NOW()),    -- Red variant (+$10)
(1, NULL, 4, 12, 7.50, 1, NOW(), NOW());    -- Blue variant (+$7.50)

-- If you want to update other products, change the product_id value
-- For example, for product ID 2:
-- INSERT IGNORE INTO product_color_assignments (product_id, color_id, created_at, updated_at) VALUES
-- (2, 1, NOW(), NOW()),
-- (2, 5, NOW(), NOW()),
-- (2, 8, NOW(), NOW());

-- Check what data was inserted
SELECT 'Colors' as table_name, COUNT(*) as count FROM product_colors
UNION ALL
SELECT 'Sizes' as table_name, COUNT(*) as count FROM product_sizes  
UNION ALL
SELECT 'Color Assignments' as table_name, COUNT(*) as count FROM product_color_assignments
UNION ALL
SELECT 'Size Assignments' as table_name, COUNT(*) as count FROM product_size_assignments
UNION ALL
SELECT 'Product Variants' as table_name, COUNT(*) as count FROM product_variants;
