# Payment Flow Testing Checklist

## 🧪 **Complete Testing Guide**

### **1. Prerequisites**
```bash
# Start the Laravel server
cd d:\work\techjoint\ecom
php artisan serve --host=127.0.0.1 --port=8000
```

### **2. Frontend Testing Steps**

#### **Step 1: Access Checkout Page**
- Open: `http://127.0.0.1:8000/checkout`
- Check: Page loads with proper styling
- Check: Cart is empty message shows if no items

#### **Step 2: Add Items to Cart** 
- Go to: `http://127.0.0.1:8000` (homepage)
- Find products and click "Add to Cart"
- Verify: Cart counter updates
- Go back to: `http://127.0.0.1:8000/checkout`
- Check: Items show in order summary
- Check: Total calculation is correct

#### **Step 3: Cart Functionality**
- Test increase/decrease buttons
- Test remove item button
- Verify: Totals update correctly
- Check: Hidden form fields update

#### **Step 4: Form Validation**
Fill out form with test data:
```
Email: test@example.com
Phone: 1234567890
First Name: John
Last Name: Doe
Address: 123 Test Street
City: Test City
State: California
Cardholder Name: John Doe
```

#### **Step 5: Email OTP (Optional)**
- Click "Validate" button
- Check: OTP section appears
- Check: Timer starts counting down
- Enter any 4-digit OTP: `1234`
- Click "Verify"

#### **Step 6: Payment Modal**
- Click "Place Order" or "Proceed to Payment"
- Check: ✅ **Payment modal opens**
- Check: ✅ **Order summary shows items**
- Check: ✅ **Cardholder name field exists**
- Check: ✅ **Card number field exists**
- Check: ✅ **Expiry field exists (MM/YY)**
- Check: ✅ **CVC field exists**

#### **Step 7: Card Input Formatting**
Test card formatting:
```
Card Number: 4111111111111111
Expected: 4111 1111 1111 1111

Expiry: 1225  
Expected: 12/25

CVC: 123
Expected: 123
```

#### **Step 8: Payment Processing**
Fill in test card details:
```
Cardholder Name: John Doe
Card Number: 4111 1111 1111 1111
Expiry: 12/25
CVC: 123
```
- Click "Complete Payment"
- Check: Modal closes
- Check: Loading message appears
- Check: Form submits to backend

### **3. Backend Testing**

#### **Step 9: Check Logs**
Monitor Laravel logs:
```bash
tail -f storage/logs/laravel.log
```

Expected log entries:
```
[INFO] Order processing started
[INFO] Stripe charge created successfully
[INFO] Order created: #123
[INFO] Payment record saved
```

#### **Step 10: Database Verification**
Check database tables:
```sql
-- Check orders table
SELECT * FROM orders ORDER BY created_at DESC LIMIT 1;

-- Check payments table  
SELECT * FROM payments ORDER BY created_at DESC LIMIT 1;

-- Check order_items table
SELECT * FROM order_items WHERE order_id = [LAST_ORDER_ID];
```

### **4. Error Scenarios**

#### **Test Invalid Inputs**
- Empty cardholder name → Should show error
- Invalid card number → Should show error  
- Invalid expiry → Should show error
- Invalid CVC → Should show error
- Empty cart → Should prevent submission

#### **Test Modal Behavior**
- Click X to close → Should close modal
- Click Cancel → Should close modal
- Click outside modal → Should close modal
- Form stays filled after closing → Data preserved

### **5. Success Indicators**

✅ **Frontend Working If:**
- Payment modal opens with all fields
- Card inputs format correctly
- Validation works for all fields
- Form submits after modal validation

✅ **Backend Working If:**
- Order record created in database
- Payment record created with Stripe charge ID
- Order items saved correctly
- Success message displayed

✅ **Complete Flow Working If:**
- User can add items → fill form → open payment modal → enter card details → submit successfully → see confirmation

### **6. Common Issues & Solutions**

**Modal Not Opening:**
- Check console for JavaScript errors
- Verify all event listeners are attached

**Card Fields Not Formatting:**
- Check if input event listeners are working
- Verify regex patterns

**Backend Errors:**
- Check .env for STRIPE_SECRET key
- Verify database connections
- Check validation rules match form fields

**Payment Failing:**
- Using test card: 4111111111111111
- Check Stripe logs in dashboard
- Verify API keys are correct

---

## 🎯 **Quick Test Commands**

```bash
# Start server
php artisan serve

# Check routes
php artisan route:list | grep -i order

# Clear cache if needed
php artisan config:clear
php artisan cache:clear

# Check migrations
php artisan migrate:status
```

## 🎮 **Test Data**

**Valid Test Card Numbers:**
```
Visa: 4111111111111111
Mastercard: 5555555555554444  
American Express: 378282246310005
```

**Test Customer Data:**
```
Email: john.doe@example.com
Phone: +1234567890
Name: John Doe
Address: 123 Main Street
City: Test City
State: California
```
