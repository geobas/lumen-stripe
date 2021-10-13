##  Lumen or Laravel Boilerplate/Starter App for Stripe payment processing 

### Core Features
* return all available subscription plans
* create a subscription 
* check subscription status 
* cancel a subscription

---

### Set up
```
1. composer install
2. composer run-script post-root-package-install
3. artisan key:generate
4. Modify the generated .env accordingly
5. artisan migrate:fresh --seed
```