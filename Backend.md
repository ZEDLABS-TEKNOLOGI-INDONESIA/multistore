# Backend Blueprint

Dokumentasi lengkap file-file backend dari project ini.

**Generated at:** 2026-02-08 22:23:58

## Struktur Backend

### Controllers


---

**File:** `./app/Http/Controllers/Controller.php`

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}

```

### Models


---

**File:** `./app/Models/CustomProduct.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Lunar\Models\Product as LunarProduct;

class CustomProduct extends LunarProduct
{
    protected $table = 'products';
}

```


---

**File:** `./app/Models/Product.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Lunar\Models\Product as LunarProduct;

class Product extends LunarProduct
{
    //
}

```


---

**File:** `./app/Models/User.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Lunar\Base\Traits\LunarUser;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, LunarUser, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

```

### Middleware


---

**File:** `./app/Http/Middleware/Authenticate.php`

```php
<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}

```


---

**File:** `./app/Http/Middleware/PreventRequestsDuringMaintenance.php`

```php
<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}

```


---

**File:** `./app/Http/Middleware/RedirectIfAuthenticated.php`

```php
<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}

```


---

**File:** `./app/Http/Middleware/TrimStrings.php`

```php
<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array<int, string>
     */
    protected $except = [
        'current_password',
        'password',
        'password_confirmation',
    ];
}

```


---

**File:** `./app/Http/Middleware/TrustHosts.php`

```php
<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

class TrustHosts extends Middleware
{
    /**
     * Get the host patterns that should be trusted.
     *
     * @return array<int, string|null>
     */
    public function hosts(): array
    {
        return [
            $this->allSubdomainsOfApplicationUrl(),
        ];
    }
}

```


---

**File:** `./app/Http/Middleware/TrustProxies.php`

```php
<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;
}

```


---

**File:** `./app/Http/Middleware/ValidateSignature.php`

```php
<?php

namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\ValidateSignature as Middleware;

class ValidateSignature extends Middleware
{
    /**
     * The names of the query string parameters that should be ignored.
     *
     * @var array<int, string>
     */
    protected $except = [
        // 'fbclid',
        // 'utm_campaign',
        // 'utm_content',
        // 'utm_medium',
        // 'utm_source',
        // 'utm_term',
    ];
}

```


---

**File:** `./app/Http/Middleware/VerifyCsrfToken.php`

```php
<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}

```

### Service Providers


---

**File:** `./app/Providers/AppServiceProvider.php`

```php
<?php

namespace App\Providers;

use App\Modifiers\ShippingModifier;
use Illuminate\Support\ServiceProvider;
use Lunar\Admin\Support\Facades\LunarPanel;
use Lunar\Base\ShippingModifiers;
use Lunar\Shipping\ShippingPlugin;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        LunarPanel::panel(
            fn ($panel) => $panel->plugins([
                new ShippingPlugin,
            ])
        )
            ->register();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(ShippingModifiers $shippingModifiers): void
    {
        $shippingModifiers->add(
            ShippingModifier::class
        );

        \Lunar\Facades\ModelManifest::replace(
            \Lunar\Models\Contracts\Product::class,
            \App\Models\Product::class,
            // \App\Models\CustomProduct::class,
        );
    }
}

```


---

**File:** `./app/Providers/AuthServiceProvider.php`

```php
<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}

```


---

**File:** `./app/Providers/BroadcastServiceProvider.php`

```php
<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        require base_path('routes/channels.php');
    }
}

```


---

**File:** `./app/Providers/EventServiceProvider.php`

```php
<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

```


---

**File:** `./app/Providers/RouteServiceProvider.php`

```php
<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}

```

### Livewire Components (Logic)


---

**File:** `./app/Livewire/CheckoutPage.php`

```php
<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Lunar\Facades\CartSession;
use Lunar\Facades\Payments;
use Lunar\Facades\ShippingManifest;
use Lunar\Models\Cart;
use Lunar\Models\CartAddress;
use Lunar\Models\Country;

class CheckoutPage extends Component
{
    /**
     * The Cart instance.
     */
    public ?Cart $cart;

    /**
     * The shipping address instance.
     */
    public ?CartAddress $shipping = null;

    /**
     * The billing address instance.
     */
    public ?CartAddress $billing = null;

    /**
     * The current checkout step.
     */
    public int $currentStep = 1;

    /**
     * Whether the shipping address is the billing address too.
     */
    public bool $shippingIsBilling = true;

    /**
     * The chosen shipping option.
     */
    public $chosenShipping = null;

    /**
     * The checkout steps.
     */
    public array $steps = [
        'shipping_address' => 1,
        'shipping_option' => 2,
        'billing_address' => 3,
        'payment' => 4,
    ];

    /**
     * The payment type we want to use.
     */
    public string $paymentType = 'cash-in-hand';

    /**
     * {@inheritDoc}
     */
    protected $listeners = [
        'cartUpdated' => 'refreshCart',
        'selectedShippingOption' => 'refreshCart',
    ];

    public $payment_intent = null;

    public $payment_intent_client_secret = null;

    protected $queryString = [
        'payment_intent',
        'payment_intent_client_secret',
    ];

    /**
     * {@inheritDoc}
     */
    public function rules(): array
    {
        return array_merge(
            $this->getAddressValidation('shipping'),
            $this->getAddressValidation('billing'),
            [
                'shippingIsBilling' => 'boolean',
                'chosenShipping' => 'required',
            ]
        );
    }

    public function mount(): void
    {
        if (! $this->cart = CartSession::current()) {
            $this->redirect('/');

            return;
        }

        if ($this->payment_intent) {
            $payment = Payments::driver($this->paymentType)->cart($this->cart)->withData([
                'payment_intent_client_secret' => $this->payment_intent_client_secret,
                'payment_intent' => $this->payment_intent,
            ])->authorize();

            if ($payment->success) {
                redirect()->route('checkout-success.view');

                return;
            }
        }

        // Do we have a shipping address?
        $this->shipping = $this->cart->shippingAddress ?: new CartAddress;

        $this->billing = $this->cart->billingAddress ?: new CartAddress;

        $this->determineCheckoutStep();
    }

    public function hydrate(): void
    {
        $this->cart = CartSession::current();
    }

    /**
     * Trigger an event to refresh addresses.
     */
    public function triggerAddressRefresh(): void
    {
        $this->dispatch('refreshAddress');
    }

    /**
     * Determines what checkout step we should be at.
     */
    public function determineCheckoutStep(): void
    {
        $shippingAddress = $this->cart->shippingAddress;
        $billingAddress = $this->cart->billingAddress;

        if ($shippingAddress) {
            if ($shippingAddress->id) {
                $this->currentStep = $this->steps['shipping_address'] + 1;
            }

            // Do we have a selected option?
            if ($this->shippingOption) {
                $this->chosenShipping = $this->shippingOption->getIdentifier();
                $this->currentStep = $this->steps['shipping_option'] + 1;
            } else {
                $this->currentStep = $this->steps['shipping_option'];
                $this->chosenShipping = $this->shippingOptions->first()?->getIdentifier();

                return;
            }
        }

        if ($billingAddress) {
            $this->currentStep = $this->steps['billing_address'] + 1;
        }
    }

    /**
     * Refresh the cart instance.
     */
    public function refreshCart(): void
    {
        $this->cart = CartSession::current();
    }

    /**
     * Return the shipping option.
     */
    public function getShippingOptionProperty()
    {
        $shippingAddress = $this->cart->shippingAddress;

        if (! $shippingAddress) {
            return;
        }

        if ($option = $shippingAddress->shipping_option) {
            return ShippingManifest::getOptions($this->cart)->first(function ($opt) use ($option) {
                return $opt->getIdentifier() == $option;
            });
        }

        return null;
    }

    /**
     * Save the address for a given type.
     */
    public function saveAddress(string $type): void
    {
        $validatedData = $this->validate(
            $this->getAddressValidation($type)
        );

        $address = $this->{$type};

        if ($type == 'billing') {
            $this->cart->setBillingAddress($address);
            $this->billing = $this->cart->billingAddress;
        }

        if ($type == 'shipping') {
            $this->cart->setShippingAddress($address);
            $this->shipping = $this->cart->shippingAddress;

            if ($this->shippingIsBilling) {
                // Do we already have a billing address?
                if ($billing = $this->cart->billingAddress) {
                    $billing->fill($validatedData['shipping']);
                    $this->cart->setBillingAddress($billing);
                } else {
                    $address = $address->only(
                        $address->getFillable()
                    );
                    $this->cart->setBillingAddress($address);
                }

                $this->billing = $this->cart->billingAddress;
            }
        }

        $this->determineCheckoutStep();
    }

    /**
     * Save the selected shipping option.
     */
    public function saveShippingOption(): void
    {
        $option = $this->shippingOptions->first(fn ($option) => $option->getIdentifier() == $this->chosenShipping);

        CartSession::setShippingOption($option);

        $this->refreshCart();

        $this->determineCheckoutStep();
    }

    public function checkout()
    {
        $payment = Payments::cart($this->cart)->withData([
            'payment_intent_client_secret' => $this->payment_intent_client_secret,
            'payment_intent' => $this->payment_intent,
        ])->authorize();

        if ($payment->success) {
            redirect()->route('checkout-success.view');

            return;
        }

        return redirect()->route('checkout-success.view');
    }

    /**
     * Return the available countries.
     */
    public function getCountriesProperty(): Collection
    {
        return Country::whereIn('iso3', ['GBR', 'USA'])->get();
    }

    /**
     * Return available shipping options.
     */
    public function getShippingOptionsProperty(): Collection
    {
        return ShippingManifest::getOptions(
            $this->cart
        );
    }

    /**
     * Return the address validation rules for a given type.
     */
    protected function getAddressValidation(string $type): array
    {
        return [
            "{$type}.first_name" => 'required',
            "{$type}.last_name" => 'required',
            "{$type}.line_one" => 'required',
            "{$type}.country_id" => 'required',
            "{$type}.city" => 'required',
            "{$type}.postcode" => 'required',
            "{$type}.company_name" => 'nullable',
            "{$type}.line_two" => 'nullable',
            "{$type}.line_three" => 'nullable',
            "{$type}.state" => 'nullable',
            "{$type}.delivery_instructions" => 'nullable',
            "{$type}.contact_email" => 'required|email',
            "{$type}.contact_phone" => 'nullable',
        ];
    }

    public function render(): View
    {
        return view('livewire.checkout-page')
            ->layout('layouts.checkout');
    }
}

```


---

**File:** `./app/Livewire/CheckoutSuccessPage.php`

```php
<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use Lunar\Facades\CartSession;
use Lunar\Models\Cart;
use Lunar\Models\Order;

class CheckoutSuccessPage extends Component
{
    public ?Cart $cart;

    public Order $order;

    public function mount(): void
    {
        $this->cart = CartSession::current();
        if (! $this->cart || ! $this->cart->completedOrder) {
            $this->redirect('/');

            return;
        }
        $this->order = $this->cart->completedOrder;

        CartSession::forget();
    }

    public function render(): View
    {
        return view('livewire.checkout-success-page');
    }
}

```


---

**File:** `./app/Livewire/CollectionPage.php`

```php
<?php

namespace App\Livewire;

use App\Traits\FetchesUrls;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Lunar\Models\Collection as CollectionModel;

class CollectionPage extends Component
{
    use FetchesUrls;

    public function mount(string $slug): void
    {
        $this->url = $this->fetchUrl(
            $slug,
            (new CollectionModel)->getMorphClass(),
            [
                'element.thumbnail',
                'element.products.variants.basePrices',
                'element.products.defaultUrl',
            ]
        );

        if (! $this->url) {
            abort(404);
        }
    }

    /**
     * Computed property to return the collection.
     */
    public function getCollectionProperty(): mixed
    {
        return $this->url->element;
    }

    public function render(): View
    {
        return view('livewire.collection-page');
    }
}

```


---

**File:** `./app/Livewire/Components/AddToCart.php`

```php
<?php

namespace App\Livewire\Components;

use Illuminate\View\View;
use Livewire\Component;
use Lunar\Base\Purchasable;
use Lunar\Facades\CartSession;

class AddToCart extends Component
{
    /**
     * The purchasable model we want to add to the cart.
     */
    public ?Purchasable $purchasable = null;

    /**
     * The quantity to add to cart.
     */
    public int $quantity = 1;

    public function rules(): array
    {
        return [
            'quantity' => 'required|numeric|min:1|max:10000',
        ];
    }

    public function addToCart(): void
    {
        $this->validate();

        if ($this->purchasable->stock < $this->quantity) {
            $this->addError('quantity', 'The quantity exceeds the available stock.');

            return;
        }

        CartSession::manager()->add($this->purchasable, $this->quantity);
        $this->dispatch('add-to-cart');
    }

    public function render(): View
    {
        return view('livewire.components.add-to-cart');
    }
}

```


---

**File:** `./app/Livewire/Components/Cart.php`

```php
<?php

namespace App\Livewire\Components;

use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Lunar\Facades\CartSession;

class Cart extends Component
{
    /**
     * The editable cart lines.
     */
    public array $lines;

    public bool $linesVisible = false;

    protected $listeners = [
        'add-to-cart' => 'handleAddToCart',
    ];

    public function rules(): array
    {
        return [
            'lines.*.quantity' => 'required|numeric|min:1|max:10000',
        ];
    }

    public function mount(): void
    {
        $this->mapLines();
    }

    /**
     * Get the current cart instance.
     */
    public function getCartProperty()
    {
        return CartSession::current();
    }

    /**
     * Return the cart lines from the cart.
     */
    public function getCartLinesProperty(): Collection
    {
        return $this->cart->lines ?? collect();
    }

    /**
     * Update the cart lines.
     */
    public function updateLines(): void
    {
        $this->validate();

        CartSession::updateLines(
            collect($this->lines)
        );
        $this->mapLines();
        $this->dispatch('cartUpdated');
    }

    public function removeLine($id): void
    {
        CartSession::remove($id);
        $this->mapLines();
    }

    /**
     * Map the cart lines.
     *
     * We want to map out our cart lines like this so we can
     * add some validation rules and make them editable.
     */
    public function mapLines(): void
    {
        $this->lines = $this->cartLines->map(function ($line) {
            return [
                'id' => $line->id,
                'identifier' => $line->purchasable->getIdentifier(),
                'quantity' => $line->quantity,
                'description' => $line->purchasable->getDescription(),
                'thumbnail' => $line->purchasable->getThumbnail()?->getUrl(),
                'option' => $line->purchasable->getOption(),
                'options' => $line->purchasable->getOptions()->implode(' / '),
                'sub_total' => $line->subTotal->formatted(),
                'unit_price' => $line->unitPrice->formatted(),
            ];
        })->toArray();
    }

    public function handleAddToCart(): void
    {
        $this->mapLines();
        $this->linesVisible = true;
    }

    public function render(): View
    {
        return view('livewire.components.cart');
    }
}

```


---

**File:** `./app/Livewire/Components/CheckoutAddress.php`

```php
<?php

namespace App\Livewire\Components;

use Illuminate\View\View;
use Livewire\Component;
use Lunar\Facades\CartSession;
use Lunar\Models\Cart;
use Lunar\Models\CartAddress;
use Lunar\Models\Country;

class CheckoutAddress extends Component
{
    /**
     * The type of address.
     */
    public string $type = 'billing';

    /**
     * The ID of the cart.
     */
    public Cart $cart;

    /**
     * Whether we are currently editing the address.
     */
    public bool $editing = false;

    /**
     * The checkout address model.
     */
    public CartAddress $address;

    /**
     * Whether billing is the same as shipping.
     */
    public bool $shippingIsBilling = false;

    protected $listeners = [
        'refreshAddress',
    ];

    public function mount(): void
    {
        $this->cart = CartSession::current();

        $this->address = $this->cart->addresses->first(fn ($add) => $add->type == $this->type) ?: new CartAddress;

        // If we have an existing ID then it should already be valid and ready to go.
        $this->editing = (bool) ! $this->address->id;
    }

    public function rules(): array
    {
        return [
            'address.first_name' => 'required',
            'address.last_name' => 'required',
            'address.line_one' => 'required',
            'address.country_id' => 'required',
            'address.city' => 'required',
            'address.postcode' => 'required',
            'address.company_name' => 'nullable',
            'address.line_two' => 'nullable',
            'address.line_three' => 'nullable',
            'address.state' => 'nullable',
            'address.delivery_instructions' => 'nullable',
            'address.contact_email' => 'nullable|email',
            'address.contact_phone' => 'nullable',
        ];
    }

    /**
     * Save the cart address.
     */
    public function save(): void
    {
        $validatedData = $this->validate();

        if ($this->type == 'billing') {
            $this->cart->setBillingAddress($this->address);
        }

        if ($this->type == 'shipping') {
            $this->cart->setShippingAddress($this->address);
            if ($this->shippingIsBilling) {
                // Do we already have a billing address?
                if ($billing = $this->cart->billingAddress) {
                    $billing->fill($validatedData['address']);
                    $this->cart->setBillingAddress($billing);
                } else {
                    $address = $this->address->only(
                        $this->address->getFillable()
                    );
                    $this->cart->setBillingAddress($address);
                }
            }
        }

        $this->editing = false;

        $this->emitUp('addressUpdated');
    }

    public function refreshAddress(): void
    {
        if ($address = $this->cart->addresses()->whereType($this->type)->first()) {
            $this->address = $address;
            $this->editing = false;
        }
    }

    public function getCountriesProperty()
    {
        return Country::whereIn('iso3', ['GBR', 'USA'])->get();
    }

    public function render(): View
    {
        return view('livewire.components.checkout-address');
    }
}

```


---

**File:** `./app/Livewire/Components/Navigation.php`

```php
<?php

namespace App\Livewire\Components;

use Illuminate\View\View;
use Livewire\Component;
use Lunar\Models\Collection;

class Navigation extends Component
{
    /**
     * The search term for the search input.
     *
     * @var string
     */
    public $term = null;

    /**
     * {@inheritDoc}
     */
    protected $queryString = [
        'term',
    ];

    /**
     * Return the collections in a tree.
     */
    public function getCollectionsProperty()
    {
        return Collection::with(['defaultUrl'])->get()->toTree();
    }

    public function render(): View
    {
        return view('livewire.components.navigation');
    }
}

```


---

**File:** `./app/Livewire/Components/ShippingOptions.php`

```php
<?php

namespace App\Livewire\Components;

use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Lunar\Facades\CartSession;
use Lunar\Facades\ShippingManifest;

class ShippingOptions extends Component
{
    /**
     * The chosen shipping option.
     */
    public ?string $chosenOption = null;

    public function mount(): void
    {
        if ($shippingOption = $this->shippingAddress?->shipping_option) {
            $option = $this->shippingOptions->first(function ($opt) use ($shippingOption) {
                return $opt->getIdentifier() == $shippingOption;
            });
            $this->chosenOption = $option?->getIdentifier();
        }
    }

    /**
     * Return available shipping options.
     */
    public function getShippingOptionsProperty(): Collection
    {
        return ShippingManifest::getOptions(
            CartSession::current()
        );
    }

    public function rules(): array
    {
        return [
            'chosenOption' => 'required',
        ];
    }

    /**
     * Save the shipping option.
     */
    public function save(): void
    {
        $this->validate();

        $option = $this->shippingOptions->first(fn ($option) => $option->getIdentifier() == $this->chosenOption);

        CartSession::setShippingOption($option);

        $this->dispatch('selectedShippingOption');
    }

    /**
     * Return whether we have a shipping address.
     */
    public function getShippingAddressProperty()
    {
        return CartSession::getCart()->shippingAddress;
    }

    public function render(): View
    {
        return view('livewire.components.shipping-options');
    }
}

```


---

**File:** `./app/Livewire/Home.php`

```php
<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use Lunar\Models\Collection;
use Lunar\Models\Url;

class Home extends Component
{
    /**
     * Return the sale collection.
     */
    public function getSaleCollectionProperty(): Collection | null
    {
        return Url::whereElementType((new Collection)->getMorphClass())->whereSlug('sale')->first()?->element ?? null;
    }

    /**
     * Return all images in sale collection.
     */
    public function getSaleCollectionImagesProperty()
    {
        if (! $this->getSaleCollectionProperty()) {
            return null;
        }

        $collectionProducts = $this->getSaleCollectionProperty()
            ->products()->inRandomOrder()->limit(4)->get();

        $saleImages = $collectionProducts->map(function ($product) {
            return $product->thumbnail;
        });

        return $saleImages->chunk(2);
    }

    /**
     * Return a random collection.
     */
    public function getRandomCollectionProperty(): ?Collection
    {
        $collections = Url::whereElementType((new Collection)->getMorphClass());

        if ($this->getSaleCollectionProperty()) {
            $collections = $collections->where('element_id', '!=', $this->getSaleCollectionProperty()?->id);
        }

        return $collections->inRandomOrder()->first()?->element;
    }

    public function render(): View
    {
        return view('livewire.home');
    }
}

```


---

**File:** `./app/Livewire/ProductPage.php`

```php
<?php

namespace App\Livewire;

use App\Traits\FetchesUrls;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Lunar\Models\Product;
use Lunar\Models\ProductVariant;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductPage extends Component
{
    use FetchesUrls;

    /**
     * The selected option values.
     */
    public array $selectedOptionValues = [];

    public function mount($slug): void
    {
        $this->url = $this->fetchUrl(
            $slug,
            (new Product)->getMorphClass(),
            [
                'element.media',
                'element.variants.basePrices.currency',
                'element.variants.basePrices.priceable',
                'element.variants.values.option',
            ]
        );

        if (! $this->url) {
            abort(404);
        }

        $this->selectedOptionValues = $this->productOptions->mapWithKeys(function ($data) {
            return [$data['option']->id => $data['values']->first()->id];
        })->toArray();
    }

    /**
     * Computed property to get variant.
     */
    public function getVariantProperty(): ProductVariant
    {
        return $this->product->variants->first(function ($variant) {
            return ! $variant->values->pluck('id')
                ->diff(
                    collect($this->selectedOptionValues)->values()
                )->count();
        });
    }

    /**
     * Computed property to return all available option values.
     */
    public function getProductOptionValuesProperty(): Collection
    {
        return $this->product->variants->pluck('values')->flatten();
    }

    /**
     * Computed propert to get available product options with values.
     */
    public function getProductOptionsProperty(): Collection
    {
        return $this->productOptionValues->unique('id')->groupBy('product_option_id')
            ->map(function ($values) {
                return [
                    'option' => $values->first()->option,
                    'values' => $values,
                ];
            })->values();
    }

    /**
     * Computed property to return product.
     */
    public function getProductProperty(): Product
    {
        return $this->url->element;
    }

    /**
     * Return all images for the product.
     */
    public function getImagesProperty(): Collection
    {
        return $this->product->media->sortBy('order_column');
    }

    /**
     * Computed property to return current image.
     */
    public function getImageProperty(): ?Media
    {
        if (count($this->variant->images)) {
            return $this->variant->images->first();
        }

        if ($primary = $this->images->first(fn ($media) => $media->getCustomProperty('primary'))) {
            return $primary;
        }

        return $this->images->first();
    }

    public function render(): View
    {
        return view('livewire.product-page');
    }
}

```


---

**File:** `./app/Livewire/SearchPage.php`

```php
<?php

namespace App\Livewire;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Lunar\Models\Product;

class SearchPage extends Component
{
    use WithPagination;

    /**
     * {@inheritDoc}
     */
    protected $queryString = [
        'term',
    ];

    /**
     * The search term.
     */
    public ?string $term = null;

    /**
     * Return the search results.
     */
    public function getResultsProperty(): LengthAwarePaginator
    {
        return Product::search($this->term)->paginate(50);
    }

    public function render(): View
    {
        return view('livewire.search-page');
    }
}

```

### Other App Files


---

**File:** `./app/Console/Kernel.php`

```php
<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

```


---

**File:** `./app/Exceptions/Handler.php`

```php
<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}

```


---

**File:** `./app/Http/Kernel.php`

```php
<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's middleware aliases.
     * *
     * * Aliases may be used instead of class names to conveniently assign middleware to routes and groups.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}

```


---

**File:** `./app/Modifiers/ShippingModifier.php`

```php
<?php

namespace App\Modifiers;

use Lunar\Models\Cart;

class ShippingModifier
{
    public function handle(Cart $cart, \Closure $next)
    {
        /**
         * Custom shipping option.
         * --------------------------------------------
         * If you do not wish to use the shipping add-on you can add
         * your own shipping options that will appear at checkout
         */

        if(config('shipping-tables.enabled') == false){
            \Lunar\Facades\ShippingManifest::addOption(
                new \Lunar\DataTypes\ShippingOption(
                    name: 'Basic Delivery',
                    description: 'Basic Delivery',
                    identifier: 'BASDEL',
                    price: new \Lunar\DataTypes\Price(500, $cart->currency, 1),
                    taxClass: \Lunar\Models\TaxClass::getDefault()
                )
            );
        }

        return $next($cart);
    }
}

```


---

**File:** `./app/Traits/FetchesUrls.php`

```php
<?php

namespace App\Traits;

use Lunar\Models\Url;

trait FetchesUrls
{
    /**
     * The URL model from the slug.
     */
    public ?Url $url = null;

    /**
     * Fetch a url model.
     *
     * @param  string  $slug
     * @param  string  $type
     * @param  array  $eagerLoad
     */
    public function fetchUrl($slug, $type, $eagerLoad = []): ?Url
    {
        return Url::whereElementType($type)
            ->whereDefault(true)
            ->whereSlug($slug)
            ->with($eagerLoad)->first();
    }
}

```


---

**File:** `./app/View/Components/ProductPrice.php`

```php
<?php

namespace App\View\Components;

use Exception;
use Illuminate\View\Component;
use Illuminate\View\View;
use Lunar\Facades\Pricing;
use Lunar\Models\Price;
use Lunar\Models\ProductVariant;

class ProductPrice extends Component
{
    public ?Price $price = null;

    public ?ProductVariant $variant = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($product = null, $variant = null)
    {
            $this->price = Pricing::for(
                $variant ?: $product->variants->first()
            )->get()->matched;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.product-price');
    }
}

```

### Routes


---

**File:** `./routes/ai.php`

```php
<?php

use Laravel\Mcp\Facades\Mcp;

// Mcp::web('/mcp/demo', \App\Mcp\Servers\PublicServer::class);

```


---

**File:** `./routes/api.php`

```php
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

```


---

**File:** `./routes/channels.php`

```php
<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

```


---

**File:** `./routes/console.php`

```php
<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

```


---

**File:** `./routes/web.php`

```php
<?php

use App\Livewire\CheckoutPage;
use App\Livewire\CheckoutSuccessPage;
use App\Livewire\CollectionPage;
use App\Livewire\Home;
use App\Livewire\ProductPage;
use App\Livewire\SearchPage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', Home::class);

Route::get('/collections/{slug}', CollectionPage::class)->name('collection.view');

Route::get('/products/{slug}', ProductPage::class)->name('product.view');

Route::get('search', SearchPage::class)->name('search.view');

Route::get('checkout', CheckoutPage::class)->name('checkout.view');

Route::get('checkout/success', CheckoutSuccessPage::class)->name('checkout-success.view');

```

### Migrations


---

**File:** `./database/migrations/0001_01_01_000000_create_users_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

```


---

**File:** `./database/migrations/0001_01_01_000001_create_cache_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};

```


---

**File:** `./database/migrations/0001_01_01_000002_create_jobs_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};

```


---

**File:** `./database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};

```


---

**File:** `./database/migrations/2021_07_29_100000_create_channels_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'channels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('handle')->unique();
            $table->boolean('default')->default(false)->index();
            $table->string('url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'channels');
    }
};

```


---

**File:** `./database/migrations/2021_07_29_100001_create_languages_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'languages', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->boolean('default')->default(false)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'languages');
    }
};

```


---

**File:** `./database/migrations/2021_07_29_100002_create_channelables_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'channelables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('channel_id')->constrained($this->prefix.'channels');
            $table->morphs('channelable');
            $table->boolean('enabled')->default(false);
            $table->datetime('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'channelables');
    }
};

```


---

**File:** `./database/migrations/2021_07_29_100003_create_currencies_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->decimal('exchange_rate', 10, 4);
            $table->string('format');
            $table->string('decimal_point');
            $table->string('thousand_point');
            $table->integer('decimal_places')->default(2)->index();
            $table->boolean('enabled')->default(false)->index();
            $table->boolean('default')->default(false)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'currencies');
    }
};

```


---

**File:** `./database/migrations/2021_07_29_100004_create_attribute_groups_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'attribute_groups', function (Blueprint $table) {
            $table->id();
            $table->string('attributable_type')->index();
            $table->json('name');
            $table->string('handle')->unique();
            $table->integer('position')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'attribute_groups');
    }
};

```


---

**File:** `./database/migrations/2021_07_29_100005_create_attributes_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'attributes', function (Blueprint $table) {
            $table->id();
            $table->string('attribute_type')->index();
            $table->foreignId('attribute_group_id')->constrained($this->prefix.'attribute_groups');
            $table->integer('position')->index();
            $table->json('name');
            $table->string('handle');
            $table->string('section');
            $table->string('type')->index();
            $table->boolean('required');
            $table->string('default_value')->nullable();
            $table->json('configuration');
            $table->boolean('system');
            $table->timestamps();

            $table->unique(['attribute_type', 'handle']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'attributes');
    }
};

```


---

**File:** `./database/migrations/2021_07_29_100006_create_attributables_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'attributables', function (Blueprint $table) {
            $table->id();
            $table->morphs('attributable');
            $table->foreignId('attribute_id')->constrained($this->prefix.'attributes');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'attributables');
    }
};

```


---

**File:** `./database/migrations/2021_07_29_100010_create_product_types_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'product_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'product_types');
    }
};

```


---

**File:** `./database/migrations/2021_07_29_100011_create_tax_classes_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'tax_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'tax_classes');
    }
};

```


---

**File:** `./database/migrations/2021_07_29_100012_create_tax_zones_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'tax_zones', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('zone_type')->index();
            $table->string('price_display');
            $table->boolean('active')->index();
            $table->boolean('default')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'tax_zones');
    }
};

```


---

**File:** `./database/migrations/2021_07_29_100020_create_products_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_type_id')->constrained($this->prefix.'product_types');
            $table->string('status')->index();
            $table->json('attribute_data');
            $table->string('brand')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'products');
    }
};

```


---

**File:** `./database/migrations/2021_07_29_100025_create_product_associations_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'product_associations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_parent_id')->constrained($this->prefix.'products');
            $table->foreignId('product_target_id')->constrained($this->prefix.'products');
            $table->string('type')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'product_associations');
    }
};

```


---

**File:** `./database/migrations/2021_07_29_100030_create_product_variants_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained($this->prefix.'products');
            $table->foreignId('tax_class_id')->constrained($this->prefix.'tax_classes');
            $table->string('tax_ref')->index()->nullable();
            $table->integer('unit_quantity')->unsigned()->index()->default(1);
            $table->string('sku')->nullable()->index();
            $table->string('gtin')->nullable()->index();
            $table->string('mpn')->nullable()->index();
            $table->string('ean')->nullable()->index();
            $table->dimensions();
            $table->boolean('shippable')->default(true)->index();
            $table->integer('stock')->default(0)->index();
            $table->integer('backorder')->default(0)->index();
            $table->string('purchasable')->default('always')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'product_variants');
    }
};

```


---

**File:** `./database/migrations/2021_07_29_100040_create_customer_groups_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'customer_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('handle')->unique();
            $table->boolean('default')->default(false)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'customer_groups');
    }
};

```


---

**File:** `./database/migrations/2021_07_29_100041_create_customer_group_product_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'customer_group_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_group_id')->constrained($this->prefix.'customer_groups');
            $table->foreignId('product_id')->constrained($this->prefix.'products');
            $table->scheduling();
            $table->boolean('visible')->default(true)->index();
            $table->boolean('purchasable')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'customer_group_product');
    }
};

```


---

**File:** `./database/migrations/2021_07_29_100041_create_customers_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'customers', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company_name')->nullable();
            $table->string('vat_no')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'customers');
    }
};

```


---

**File:** `./database/migrations/2021_07_29_100042_create_customer_customer_group_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'customer_customer_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained($this->prefix.'customers');
            $table->foreignId('customer_group_id')->constrained($this->prefix.'customer_groups');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'customer_customer_group');
    }
};

```


---

**File:** `./database/migrations/2021_07_29_100042_create_customer_user_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'customer_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained($this->prefix.'customers');
            $table->userForeignKey();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'customer_user');
    }
};

```


---

**File:** `./database/migrations/2021_07_29_100050_create_prices_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_group_id')->nullable()->constrained($this->prefix.'customer_groups');
            $table->foreignId('currency_id')->nullable()->constrained($this->prefix.'currencies');
            $table->morphs('priceable');
            $table->integer('price')->unsigned()->index();
            $table->integer('compare_price')->unsigned()->nullable();
            $table->integer('tier')->default(1)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'prices');
    }
};

```


---

**File:** `./database/migrations/2021_07_30_100000_create_countries_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('iso3')->unique();
            $table->string('iso2')->unique()->nullable();
            $table->string('phonecode');
            $table->string('capital')->nullable();
            $table->string('currency');
            $table->string('native')->nullable();
            $table->string('emoji');
            $table->string('emoji_u');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'countries');
    }
};

```


---

**File:** `./database/migrations/2021_07_30_100001_create_states_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'states', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->nullable()->constrained($this->prefix.'countries');
            $table->string('name');
            $table->string('code');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'states');
    }
};

```


---

**File:** `./database/migrations/2021_07_30_100002_create_addresses_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained($this->prefix.'customers');
            $table->foreignId('country_id')->nullable()->constrained($this->prefix.'countries');
            $table->string('title')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company_name')->nullable();
            $table->string('line_one');
            $table->string('line_two')->nullable();
            $table->string('line_three')->nullable();
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('postcode')->nullable();
            $table->string('delivery_instructions')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->json('meta')->nullable();
            $table->boolean('shipping_default')->default(false);
            $table->boolean('billing_default')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'addresses');
    }
};

```


---

**File:** `./database/migrations/2021_07_30_100003_create_tax_zone_countries_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'tax_zone_countries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tax_zone_id')->nullable()->constrained($this->prefix.'tax_zones');
            $table->foreignId('country_id')->nullable()->constrained($this->prefix.'countries');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'tax_zone_countries');
    }
};

```


---

**File:** `./database/migrations/2021_07_30_100004_create_tax_zone_states_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'tax_zone_states', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tax_zone_id')->nullable()->constrained($this->prefix.'tax_zones');
            $table->foreignId('state_id')->nullable()->constrained($this->prefix.'states');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'tax_zone_states');
    }
};

```


---

**File:** `./database/migrations/2021_07_30_100005_create_tax_zone_postcodes_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'tax_zone_postcodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tax_zone_id')->nullable()->constrained($this->prefix.'tax_zones');
            $table->foreignId('country_id')->nullable()->constrained($this->prefix.'countries');
            $table->string('postcode', 20)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'tax_zone_postcodes');
    }
};

```


---

**File:** `./database/migrations/2021_07_30_100006_create_tax_zone_customer_groups_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'tax_zone_customer_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tax_zone_id')->nullable()->constrained($this->prefix.'tax_zones');
            $table->foreignId('customer_group_id')->nullable()->constrained($this->prefix.'customer_groups');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'tax_zone_customer_groups');
    }
};

```


---

**File:** `./database/migrations/2021_07_30_100007_create_tax_rates_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'tax_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tax_zone_id')->nullable()->constrained($this->prefix.'tax_zones');
            $table->tinyInteger('priority')->default(1)->index()->unsigned();
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'tax_rates');
    }
};

```


---

**File:** `./database/migrations/2021_07_30_100008_create_tax_rate_amounts_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'tax_rate_amounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tax_class_id')->nullable()->constrained($this->prefix.'tax_classes');
            $table->foreignId('tax_rate_id')->nullable()->constrained($this->prefix.'tax_rates');
            $table->decimal('percentage', 7, 3)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'tax_rate_amounts');
    }
};

```


---

**File:** `./database/migrations/2021_08_10_101547_create_media_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('media')) {
            Schema::create('media', function (Blueprint $table) {
                $table->bigIncrements('id');

                $table->morphs('model');
                $table->uuid('uuid')->nullable()->unique();
                $table->string('collection_name');
                $table->string('name');
                $table->string('file_name');
                $table->string('mime_type')->nullable();
                $table->string('disk');
                $table->string('conversions_disk')->nullable();
                $table->unsignedBigInteger('size');
                $table->json('manipulations');
                $table->json('custom_properties');
                $table->json('generated_conversions');
                $table->json('responsive_images');
                $table->unsignedInteger('order_column')->nullable();

                $table->nullableTimestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};

```


---

**File:** `./database/migrations/2021_08_10_102000_create_collection_groups_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'collection_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('handle')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'collection_groups');
    }
};

```


---

**File:** `./database/migrations/2021_08_10_103000_create_collections_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_group_id')->constrained($this->prefix.'collection_groups');
            $table->nestedSet();
            $table->string('type')->default('static')->index();
            $table->json('attribute_data');
            $table->string('sort')->default('custom')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'collections');
    }
};

```


---

**File:** `./database/migrations/2021_08_10_103001_create_collection_product_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'collection_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_id')->constrained($this->prefix.'collections');
            $table->foreignId('product_id')->constrained($this->prefix.'products');
            $table->integer('position')->default(1)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'collection_product');
    }
};

```


---

**File:** `./database/migrations/2021_08_10_103002_create_collection_customer_group_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'collection_customer_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_id')->constrained($this->prefix.'collections');
            $table->foreignId('customer_group_id')->constrained($this->prefix.'customer_groups');
            $table->scheduling();
            $table->boolean('visible')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'collection_customer_group');
    }
};

```


---

**File:** `./database/migrations/2021_08_17_142630_create_activity_log_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $tableName = config('activitylog.table_name');

        if (! Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('log_name')->nullable();
                $table->text('description');
                $table->nullableMorphs('subject', 'subject');
                $table->string('event')->nullable();
                $table->nullableMorphs('causer', 'causer');
                $table->json('properties')->nullable();
                $table->uuid('batch_uuid')->nullable();
                $table->timestamps();
                $table->index('log_name');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists(config('activitylog.table_name'));
    }
};

```


---

**File:** `./database/migrations/2021_09_09_100000_create_product_options_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'product_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'product_options');
    }
};

```


---

**File:** `./database/migrations/2021_09_09_100001_create_product_option_values_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'product_option_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('product_option_id')->constrained($this->prefix.'product_options');
            $table->json('name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'product_option_values');
    }
};

```


---

**File:** `./database/migrations/2021_09_09_100010_create_product_option_value_product_variant_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'product_option_value_product_variant', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('value_id')->constrained($this->prefix.'product_option_values');
            $table->foreignId('variant_id')->constrained($this->prefix.'product_variants');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'product_option_value_product_variant');
    }
};

```


---

**File:** `./database/migrations/2021_09_10_100000_create_tags_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'tags');
    }
};

```


---

**File:** `./database/migrations/2021_09_10_100001_create_taggables_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'taggables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('tag_id')->constrained($this->prefix.'tags');
            $table->morphs('taggable');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'taggables');
    }
};

```


---

**File:** `./database/migrations/2021_09_29_100000_create_urls_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'urls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('language_id')->constrained($this->prefix.'languages');
            $table->morphs('element');
            $table->string('slug')->index();
            $table->boolean('default')->default(false)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'urls');
    }
};

```


---

**File:** `./database/migrations/2021_10_01_090000_create_orders_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->userForeignKey(nullable: true);
            $table->foreignId('channel_id')->constrained($this->prefix.'channels');
            $table->string('status')->index();
            $table->string('reference')->nullable()->unique();
            $table->string('customer_reference')->nullable();
            $table->integer('sub_total')->unsigned()->index();
            $table->integer('discount_total')->default(0)->unsigned()->index();
            $table->integer('shipping_total')->default(0)->unsigned()->index();
            $table->json('tax_breakdown');
            $table->integer('tax_total')->unsigned()->index();
            $table->integer('total')->unsigned()->index();
            $table->text('notes')->nullable();
            $table->string('currency_code', 3);
            $table->string('compare_currency_code', 3)->nullable();
            $table->decimal('exchange_rate', 10, 4)->default(1);
            $table->dateTime('placed_at')->nullable()->index();
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'orders');
    }
};

```


---

**File:** `./database/migrations/2021_10_01_090001_create_order_lines_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'order_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('order_id')->constrained($this->prefix.'orders');
            $table->morphs('purchasable');
            $table->string('type')->index();
            $table->string('description');
            $table->string('option')->nullable();
            $table->string('identifier')->index();
            $table->integer('unit_price')->unsigned()->index();
            $table->smallInteger('unit_quantity')->default(1)->unsigned()->index();
            $table->smallInteger('quantity')->unsigned();
            $table->integer('sub_total')->unsigned()->index();
            $table->integer('discount_total')->default(0)->unsigned()->index();
            $table->json('tax_breakdown');
            $table->integer('tax_total')->unsigned()->index();
            $table->integer('total')->unsigned()->index();
            $table->text('notes')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'order_lines');
    }
};

```


---

**File:** `./database/migrations/2021_10_01_090002_create_order_addresses_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'order_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('order_id')->constrained($this->prefix.'orders');
            $table->foreignId('country_id')->nullable()->constrained($this->prefix.'countries');
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('line_one')->nullable();
            $table->string('line_two')->nullable();
            $table->string('line_three')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postcode')->nullable();
            $table->string('delivery_instructions')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('type')->default('shipping')->index();
            $table->string('shipping_option')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'order_addresses');
    }
};

```


---

**File:** `./database/migrations/2021_10_01_090003_create_transactions_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('order_id')->constrained($this->prefix.'orders');
            $table->boolean('success')->index();
            $table->boolean('refund')->default(false)->index();
            $table->string('driver');
            $table->integer('amount')->unsigned()->index();
            $table->string('reference')->index();
            $table->string('status');
            $table->string('notes')->nullable();
            $table->string('card_type', 25)->index();
            $table->smallInteger('last_four');
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'transactions');
    }
};

```


---

**File:** `./database/migrations/2021_10_01_100000_create_carts_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->userForeignKey(nullable: true);
            $table->foreignId('merged_id')->nullable()->constrained($this->prefix.'carts');
            $table->foreignId('currency_id')->constrained($this->prefix.'currencies');
            $table->foreignId('channel_id')->constrained($this->prefix.'channels');
            $table->foreignId('order_id')->nullable()->constrained($this->prefix.'orders');
            $table->string('coupon_code')->index()->nullable();
            $table->dateTime('completed_at')->nullable()->index();
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'carts');
    }
};

```


---

**File:** `./database/migrations/2021_10_01_100001_create_cart_addresses_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'cart_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('cart_id')->constrained($this->prefix.'carts');
            $table->foreignId('country_id')->nullable()->constrained($this->prefix.'countries');
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('line_one')->nullable();
            $table->string('line_two')->nullable();
            $table->string('line_three')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postcode')->nullable();
            $table->string('delivery_instructions')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('type')->default('shipping')->index();
            $table->string('shipping_option')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'cart_addresses');
    }
};

```


---

**File:** `./database/migrations/2021_10_01_100001_create_cart_lines_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'cart_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('cart_id')->constrained($this->prefix.'carts');
            $table->morphs('purchasable');
            $table->smallInteger('quantity')->unsigned();
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'cart_lines');
    }
};

```


---

**File:** `./database/migrations/2022_01_12_100000_add_columns_to_attributes_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'attributes', function (Blueprint $table) {
            $table->boolean('searchable')->after('system')->default(true)->index();
            $table->boolean('filterable')->after('system')->default(false)->index();
            $table->string('validation_rules')->after('system')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'attributes', function (Blueprint $table) {
            $table->dropIndex(['searchable']);
            $table->dropIndex(['filterable']);
            $table->dropColumn(['searchable', 'filterable', 'validation_rules']);
        });
    }
};

```


---

**File:** `./database/migrations/2022_01_12_100001_add_attribute_data_to_product_variants_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'product_variants', function (Blueprint $table) {
            $table->json('attribute_data')->after('tax_class_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'product_variants', function (Blueprint $table) {
            $table->dropColumn('attribute_data');
        });
    }
};

```


---

**File:** `./database/migrations/2022_01_12_100002_add_default_column_to_tax_classes_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'tax_classes', function (Blueprint $table) {
            $table->boolean('default')->after('name')->index()->default(false);
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'tax_classes', function (Blueprint $table) {
            $table->dropIndex(['default']);
            $table->dropColumn('default');
        });
    }
};

```


---

**File:** `./database/migrations/2022_01_18_100000_add_starts_ends_at_to_channelables_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        /**
         * SQLite will only allow one per transaction when modifying columns.
         */
        Schema::table($this->prefix.'channelables', function (Blueprint $table) {
            $table->renameColumn('published_at', 'starts_at');
        });

        Schema::table($this->prefix.'channelables', function (Blueprint $table) {
            $table->dateTime('ends_at')->after('starts_at')->nullable()->index();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'channelables', function (Blueprint $table) {
            $table->renameColumn('starts_at', 'published_at');
        });

        Schema::table($this->prefix.'channelables', function (Blueprint $table) {
            $table->dropIndex(['ends_at']);
            $table->dropColumn('ends_at');
        });
    }
};

```


---

**File:** `./database/migrations/2022_01_18_100001_add_customer_id_to_orders_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'orders', function (Blueprint $table) {
            $table->foreignId('customer_id')->after('id')
                ->nullable()
                ->constrained($this->prefix.'customers');
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'orders', function (Blueprint $table) {
            if ($this->canDropForeignKeys()) {
                $table->dropForeign(['customer_id']);
            }
            $table->dropColumn('customer_id');
        });
    }
};

```


---

**File:** `./database/migrations/2022_03_11_100000_remove_formatting_columns_from_currencies_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'currencies', function (Blueprint $table) {
            $table->dropColumn(['format', 'decimal_point', 'thousand_point']);
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'currencies', function (Blueprint $table) {
            $table->string('format')->nullable();
            $table->string('decimal_point')->nullable();
            $table->string('thousand_point')->nullable();
        });
    }
};

```


---

**File:** `./database/migrations/2022_03_17_100000_add_fields_to_transactions_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'transactions', function (Blueprint $table) {
            $table->foreignId('parent_transaction_id')->after('id')
                ->nullable()
                ->constrained($this->prefix.'transactions');
            $table->dateTime('captured_at')->nullable()->index();
            $table->enum('type', ['refund', 'intent', 'capture'])->after('success')->index()->default('capture');
        });

        Schema::table($this->prefix.'transactions', function (Blueprint $table) {
            $table->dropIndex(['refund']);
            $table->dropColumn('refund');
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'transactions', function (Blueprint $table) {
            if ($this->canDropForeignKeys()) {
                $table->dropForeign(['parent_transaction_id']);
            }
            $table->dropIndex(['type']);
            $table->dropColumn(['parent_transaction_id', 'type']);
        });

        Schema::table($this->prefix.'transactions', function (Blueprint $table) {
            $table->boolean('refund')->default(false)->index();
        });
    }
};

```


---

**File:** `./database/migrations/2022_03_29_100000_update_quantity_on_cart_lines_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'cart_lines', function (Blueprint $table) {
            $table->unsignedInteger('quantity')->change();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'cart_lines', function (Blueprint $table) {
            $table->smallInteger('quantity')->unsigned()->change();
        });
    }
};

```


---

**File:** `./database/migrations/2022_03_30_100000_update_quantity_on_order_lines_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'order_lines', function (Blueprint $table) {
            $table->unsignedInteger('quantity')->change();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'order_lines', function (Blueprint $table) {
            $table->smallInteger('quantity')->unsigned()->change();
        });
    }
};

```


---

**File:** `./database/migrations/2022_05_10_100000_fix_last_four_on_transactions_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'transactions', function (Blueprint $table) {
            $table->string('last_four', 4)->change();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'transactions', function (Blueprint $table) {
            $table->smallInteger('last_four')->unsigned()->change();
        });
    }
};

```


---

**File:** `./database/migrations/2022_05_19_100000_add_attributes_to_customers_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'customers', function (Blueprint $table) {
            $table->json('attribute_data')->after('vat_no')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'customers', function (Blueprint $table) {
            $table->dropColumn('attribute_data');
        });
    }
};

```


---

**File:** `./database/migrations/2022_06_29_100000_create_assets_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'assets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'assets');
    }
};

```


---

**File:** `./database/migrations/2022_07_15_100000_set_last_four_to_nullable_on_transactions.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'transactions', function (Blueprint $table) {
            $table->string('last_four')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'transactions', function (Blueprint $table) {
            $table->string('last_four')->nullable(false)->change();
        });
    }
};

```


---

**File:** `./database/migrations/2022_07_23_215417_add_handle_position_to_product_options_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'product_options', function (Blueprint $table) {
            // @note Made nullable for now to avoid breaking changes.
            $table->string('handle')->after('name')->unique()->nullable();
            $table->integer('position')->after('name')->default(0)->index();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'product_options', function (Blueprint $table) {
            $table->dropUnique(['handle']);
            $table->dropColumn(['handle', 'position']);
        });
    }
};

```


---

**File:** `./database/migrations/2022_07_23_215418_add_position_to_product_option_values_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'product_option_values', function (Blueprint $table) {
            $table->integer('position')->after('name')->default(0)->index();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'product_option_values', function (Blueprint $table) {
            $table->dropIndex(['position']);
            $table->dropColumn('position');
        });
    }
};

```


---

**File:** `./database/migrations/2022_08_09_100000_create_media_variant_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'media_product_variant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('media_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_variant_id')->constrained($this->prefix.'product_variants')->onDelete('cascade');
            $table->boolean('primary')->default(false)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'media_product_variant');
    }
};

```


---

**File:** `./database/migrations/2022_08_09_100001_create_brands_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'brands');
    }
};

```


---

**File:** `./database/migrations/2022_08_09_100002_add_brand_id_to_products_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'products', function (Blueprint $table) {
            $table->foreignId('brand_id')->after('id')
                ->nullable()
                ->constrained($this->prefix.'brands');
        });

        Schema::table($this->prefix.'products', function (Blueprint $table) {
            if (Schema::hasIndex($this->prefix.'products', ['brand'])) {
                $table->dropIndex(['brand']);
            }
            $table->dropColumn('brand');
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'products', function (Blueprint $table) {
            if ($this->canDropForeignKeys()) {
                $table->dropForeign(['brand_id']);
            }
            $table->dropColumn('brand_id');
        });
    }
};

```


---

**File:** `./database/migrations/2022_09_05_100000_add_account_ref_to_customers_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'customers', function (Blueprint $table) {
            $table->string('account_ref')->nullable()->index()->after('vat_no');
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'customers', function (Blueprint $table) {
            $table->dropIndex(['account_ref']);
            $table->dropColumn('account_ref');
        });
    }
};

```


---

**File:** `./database/migrations/2022_09_08_100000_add_position_to_media_product_variant_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'media_product_variant', function (Blueprint $table) {
            $table->smallInteger('position')->after('primary')->default(1)->index();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'media_product_variant', function (Blueprint $table) {
            $table->dropIndex(['position']);
            $table->dropColumn('position');
        });
    }
};

```


---

**File:** `./database/migrations/2022_11_13_110447_update_prices_on_prices_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'prices', function (Blueprint $table) {
            $table->unsignedBigInteger('price')->change();
            $table->unsignedBigInteger('compare_price')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'prices', function (Blueprint $table) {
            $table->unsignedInteger('price')->change();
            $table->unsignedInteger('compare_price')->change();
        });
    }
};

```


---

**File:** `./database/migrations/2022_11_13_111734_update_prices_on_orders_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'orders', function (Blueprint $table) {
            $table->unsignedBigInteger('sub_total')->change();
            $table->unsignedBigInteger('discount_total')->change();
            $table->unsignedBigInteger('shipping_total')->change();
            $table->unsignedBigInteger('tax_total')->change();
            $table->unsignedBigInteger('total')->change();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'orders', function (Blueprint $table) {
            $table->unsignedInteger('sub_total')->change();
            $table->unsignedInteger('discount_total')->change();
            $table->unsignedInteger('shipping_total')->change();
            $table->unsignedInteger('tax_total')->change();
            $table->unsignedInteger('total')->change();
        });
    }
};

```


---

**File:** `./database/migrations/2022_11_13_111744_update_prices_on_order_lines_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'order_lines', function (Blueprint $table) {
            $table->unsignedBigInteger('unit_price')->change();
            $table->unsignedBigInteger('sub_total')->change();
            $table->unsignedBigInteger('discount_total')->change();
            $table->unsignedBigInteger('tax_total')->change();
            $table->unsignedBigInteger('total')->change();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'order_lines', function (Blueprint $table) {
            $table->unsignedInteger('unit_price')->change();
            $table->unsignedInteger('sub_total')->change();
            $table->unsignedInteger('discount_total')->change();
            $table->unsignedInteger('tax_total')->change();
            $table->unsignedInteger('total')->change();
        });
    }
};

```


---

**File:** `./database/migrations/2022_11_18_100000_create_discounts_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'discounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('handle')->unique();
            $table->string('coupon')->nullable()->unique();
            $table->string('type')->index();
            $table->dateTime('starts_at')->index();
            $table->dateTime('ends_at')->nullable()->index();
            $table->integer('uses')->unsigned()->default(0)->index();
            $table->mediumInteger('max_uses')->unsigned()->nullable();
            $table->mediumInteger('priority')->unsigned()->index()->default(1);
            $table->boolean('stop')->default(false)->index();
            $table->string('restriction')->index()->nullable();
            $table->json('data')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'discounts');
    }
};

```


---

**File:** `./database/migrations/2022_11_18_100005_create_cart_line_discount_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'cart_line_discount', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_line_id')->constrained($this->prefix.'carts')->cascadeOnDelete();
            $table->foreignId('discount_id')->constrained($this->prefix.'discounts')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'cart_line_discount');
    }
};

```


---

**File:** `./database/migrations/2022_11_18_100010_create_brand_discount_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'brand_discount', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained($this->prefix.'brands')->cascadeOnDelete();
            $table->foreignId('discount_id')->constrained($this->prefix.'discounts')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'brand_discount');
    }
};

```


---

**File:** `./database/migrations/2022_11_18_100015_create_customer_group_discount_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'customer_group_discount', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_id')->constrained($this->prefix.'discounts');
            $table->foreignId('customer_group_id')->constrained($this->prefix.'customer_groups');
            $table->scheduling();
            $table->boolean('visible')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'customer_group_discount');
    }
};

```


---

**File:** `./database/migrations/2022_11_18_100020_create_discount_collections_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'collection_discount', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_id')->constrained($this->prefix.'discounts')->cascadeOnDelete();
            $table->foreignId('collection_id')->constrained($this->prefix.'collections')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'collection_discount');
    }
};

```


---

**File:** `./database/migrations/2022_11_18_100030_create_discount_purchasables_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'discount_purchasables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_id')->constrained($this->prefix.'discounts')->cascadeOnDelete();
            $table->morphs('purchasable', 'purchasable_idx');
            $table->string('type')->default('condition')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'discount_purchasables');
    }
};

```


---

**File:** `./database/migrations/2022_12_09_100000_add_new_customer_flag_to_orders_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'orders', function (Blueprint $table) {
            $table->boolean('new_customer')->after('channel_id')->default(false)->index();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'orders', function (Blueprint $table) {
            $table->dropIndex(['new_customer']);
            $table->dropColumn('new_customer');
        });
    }
};

```


---

**File:** `./database/migrations/2023_03_03_100001_add_discount_breakdown_to_orders_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'orders', function (Blueprint $table) {
            $table->json('discount_breakdown')->nullable()->after('sub_total');
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'orders', function (Blueprint $table) {
            $table->dropColumn('discount_breakdown');
        });
    }
};

```


---

**File:** `./database/migrations/2023_03_03_100001_add_max_uses_per_user_to_discounts_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'discounts', function (Blueprint $table) {
            $table->mediumInteger('max_uses_per_user')->unsigned()->nullable()->after('max_uses');
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'discounts', function (Blueprint $table) {
            $table->dropColumn('max_uses_per_user');
        });
    }
};

```


---

**File:** `./database/migrations/2023_03_13_100030_create_discount_user_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'discount_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_id')->constrained($this->prefix.'discounts')->cascadeOnDelete();
            $table->userForeignKey();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'discount_user');
    }
};

```


---

**File:** `./database/migrations/2023_04_19_100000_add_shipping_breakdown_to_orders_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'orders', function (Blueprint $table) {
            $table->json('shipping_breakdown')->nullable()->after('discount_total');
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'orders', function (Blueprint $table) {
            $table->dropColumn('shipping_breakdown');
        });
    }
};

```


---

**File:** `./database/migrations/2023_05_20_100000_add_customer_id_to_carts_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'carts', function (Blueprint $table) {
            $table->foreignId('customer_id')->after('user_id')
                ->nullable()
                ->constrained($this->prefix.'customers');
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'carts', function (Blueprint $table) {
            if ($this->canDropForeignKeys()) {
                $table->dropForeign(['customer_id']);
            }
            $table->dropColumn('customer_id');
        });
    }
};

```


---

**File:** `./database/migrations/2023_05_26_100000_add_label_to_product_options_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'product_options', function (Blueprint $table) {
            $table->json('label')->nullable()->after('name');
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'product_options', function (Blueprint $table) {
            $table->dropColumn('label');
        });
    }
};

```


---

**File:** `./database/migrations/2023_06_07_100000_add_cart_id_to_orders_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'orders', function (Blueprint $table) {
            $table->foreignId('cart_id')->after('user_id')->nullable()->constrained($this->prefix.'carts')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'orders', function (Blueprint $table) {
            if ($this->canDropForeignKeys()) {
                $table->dropForeign(['cart_id']);
            }
            $table->dropColumn('cart_id');
        });
    }
};

```


---

**File:** `./database/migrations/2023_08_16_100013_add_attributes_to_brands_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'brands', function (Blueprint $table) {
            $table->json('attribute_data')->after('name')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'brands', function (Blueprint $table) {
            $table->dropColumn('attribute_data');
        });
    }
};

```


---

**File:** `./database/migrations/2023_09_21_100000_set_section_to_nullable_on_attributes.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'attributes', function (Blueprint $table) {
            $table->string('section')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'attributes', function (Blueprint $table) {
            $table->string('section')->nullable(false)->change();
        });
    }
};

```


---

**File:** `./database/migrations/2023_10_06_100010_add_type_to_brand_discount_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'brand_discount', function (Blueprint $table) {
            $table->string('type', 20)->after('discount_id')->default('limitation');
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'brand_discount', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};

```


---

**File:** `./database/migrations/2023_10_06_100010_add_type_to_collection_discount_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'collection_discount', function (Blueprint $table) {
            $table->string('type', 20)->after('collection_id')->default('limitation');
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'collection_discount', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};

```


---

**File:** `./database/migrations/2023_12_18_100000_add_quantity_increment_min_quantity_to_product_variants_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'product_variants', function (Blueprint $table) {
            $table->integer('quantity_increment')->after('unit_quantity')->unsigned()->default(1)->index();
            $table->integer('min_quantity')->after('unit_quantity')->unsigned()->default(1)->index();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'product_variants', function (Blueprint $table) {
            $table->dropIndex(['quantity_increment']);
            $table->dropColumn('quantity_increment');
        });

        Schema::table($this->prefix.'product_variants', function (Blueprint $table) {
            $table->dropIndex(['min_quantity']);
            $table->dropColumn('min_quantity');
        });
    }
};

```


---

**File:** `./database/migrations/2024_01_04_100013_add_attributes_to_customer_groups_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'customer_groups', function (Blueprint $table) {
            $table->json('attribute_data')->after('default')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'customer_groups', function ($table) {
            $table->dropColumn('attribute_data');
        });
    }
};

```


---

**File:** `./database/migrations/2024_01_11_100000_add_description_to_attributes_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'attributes', function (Blueprint $table) {
            $table->json('description')->after('name')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'attributes', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};

```


---

**File:** `./database/migrations/2024_01_16_100000_create_product_product_option_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'product_product_option', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained($this->prefix.'products');
            $table->foreignId('product_option_id')->constrained($this->prefix.'product_options');
            $table->smallInteger('position')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'product_product_option');
    }
};

```


---

**File:** `./database/migrations/2024_01_16_100010_update_product_option_relations.php`

```php
<?php

use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;
use Lunar\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $variantsTable = $this->prefix.'product_variants';
        $productsTable = $this->prefix.'products';
        $optionsTable = $this->prefix.'product_options';
        $optionValueTable = $this->prefix.'product_option_values';
        $variantOptionsValueTable = $this->prefix.'product_option_value_product_variant';

        DB::table($variantOptionsValueTable)->join(
            $variantsTable,
            "{$variantOptionsValueTable}.variant_id",
            '=',
            "{$variantsTable}.id"
        )->join(
            $optionValueTable,
            "{$variantOptionsValueTable}.value_id",
            '=',
            "{$optionValueTable}.id"
        )->join(
            $optionsTable,
            "{$optionValueTable}.product_option_id",
            '=',
            "{$optionsTable}.id"
        )->join(
            $productsTable,
            "{$variantsTable}.product_id",
            '=',
            "{$productsTable}.id"
        )->select([
            "{$productsTable}.id as product_id",
            "{$optionsTable}.id as product_option_id",
            "{$optionsTable}.position",
        ])->groupBy([
            "{$productsTable}.id",
            "{$optionsTable}.id",
            "{$optionsTable}.position",
        ])
            ->orderBy("{$productsTable}.id")
            ->chunk(200, function ($rows) {
                DB::table(
                    $this->prefix.'product_product_option'
                )->insert(
                    $rows->map(
                        fn ($row) => (array) $row
                    )->toArray()
                );
            });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'product_product_option');
    }
};

```


---

**File:** `./database/migrations/2024_01_16_100020_remove_position_from_product_options_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'product_options', function (Blueprint $table) {
            $table->dropIndex(['position']);
            $table->dropColumn('position');
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'product_options', function (Blueprint $table) {
            $table->smallInteger('position')->after('label');
        });
    }
};

```


---

**File:** `./database/migrations/2024_01_16_100030_add_and_set_shared_to_product_options_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'product_options', function (Blueprint $table) {
            $table->boolean('shared')->after('handle')->default(false)->index();
        });

        \Lunar\Facades\DB::table($this->prefix.'product_options')->update([
            'shared' => true,
        ]);
    }

    public function down(): void
    {
        Schema::table($this->prefix.'product_options', function (Blueprint $table) {
            $table->dropIndex(['shared']);
            $table->dropColumn('shared');
        });
    }
};

```


---

**File:** `./database/migrations/2024_01_24_100000_update_product_option_handle_fk.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'product_options', function (Blueprint $table) {
            $table->dropUnique(
                $this->prefix.'product_options_handle_unique'
            );
        });

        Schema::table($this->prefix.'product_options', function (Blueprint $table) {
            $table->index('handle');
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'product_options', function (Blueprint $table) {
            $table->dropIndex(
                $this->prefix.'product_options_handle_index'
            );
        });

        Schema::table($this->prefix.'product_options', function (Blueprint $table) {
            $table->unique('handle');
        });
    }
};

```


---

**File:** `./database/migrations/2024_01_29_100000_update_nullable_currency_on_prices_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'prices', function (Blueprint $table) {
            $table->foreignId('currency_id')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'prices', function (Blueprint $table) {
            $table->foreignId('currency_id')->nullable(true)->change();
        });
    }
};

```


---

**File:** `./database/migrations/2024_01_31_100000_update_tier_to_min_quantity_on_prices_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'prices', function (Blueprint $table) {
            if (Schema::hasColumn($this->prefix.'prices', 'tier')) {
                $table->renameColumn('tier', 'min_quantity');
            }
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'prices', function (Blueprint $table) {
            if (Schema::hasColumn($this->prefix.'prices', 'min_quantity')) {
                $table->renameColumn('min_quantity', 'tier');
            }
        });
    }
};

```


---

**File:** `./database/migrations/2024_03_15_100000_remap_polymorphic_relations.php`

```php
<?php

use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

class RemapPolymorphicRelations extends Migration
{
    public function up()
    {
        $modelClasses = collect([
            \Lunar\Models\CartLine::class,
            \Lunar\Models\ProductOption::class,
            \Lunar\Models\Asset::class,
            \Lunar\Models\Brand::class,
            \Lunar\Models\TaxZone::class,
            \Lunar\Models\TaxZoneCountry::class,
            \Lunar\Models\TaxZoneCustomerGroup::class,
            \Lunar\Models\DiscountCollection::class,
            \Lunar\Models\TaxClass::class,
            \Lunar\Models\ProductOptionValue::class,
            \Lunar\Models\Channel::class,
            \Lunar\Models\AttributeGroup::class,
            \Lunar\Models\Tag::class,
            \Lunar\Models\Cart::class,
            \Lunar\Models\Collection::class,
            \Lunar\Models\Discount::class,
            \Lunar\Models\TaxRate::class,
            \Lunar\Models\Price::class,
            \Lunar\Models\Discountable::class,
            \Lunar\Models\State::class,
            \Lunar\Models\UserPermission::class,
            \Lunar\Models\OrderAddress::class,
            \Lunar\Models\Country::class,
            \Lunar\Models\Address::class,
            \Lunar\Models\Url::class,
            \Lunar\Models\ProductVariant::class,
            \Lunar\Models\TaxZonePostcode::class,
            \Lunar\Models\ProductAssociation::class,
            \Lunar\Models\TaxRateAmount::class,
            \Lunar\Models\Attribute::class,
            \Lunar\Models\Order::class,
            \Lunar\Models\Customer::class,
            \Lunar\Models\OrderLine::class,
            \Lunar\Models\CartAddress::class,
            \Lunar\Models\Language::class,
            \Lunar\Models\TaxZoneState::class,
            \Lunar\Models\Currency::class,
            \Lunar\Models\Product::class,
            \Lunar\Models\Transaction::class,
            \Lunar\Models\ProductType::class,
            \Lunar\Models\CollectionGroup::class,
            \Lunar\Models\CustomerGroup::class,
        ])->mapWithKeys(
            fn ($class) => [
                $class => \Lunar\Facades\ModelManifest::getMorphMapKey($class),
            ]
        );

        $tables = [
            'attributables' => ['attributable_type'],
            'attributes' => ['attribute_type'],
            'attribute_groups' => ['attributable_type'],
            'cart_lines' => ['purchasable_type'],
            'channelables' => ['channelable_type'],
            'discount_purchasables' => ['purchasable_type'],
            'order_lines' => ['purchasable_type'],
            'prices' => ['priceable_type'],
            'taggables' => ['taggable_type'],
            'urls' => ['element_type'],
        ];

        $nonLunarTables = [
            'activity_log' => 'subject_type',
            'media' => 'model_type',
            'model_has_permissions' => 'model_type',
            'model_has_roles' => 'model_type',
        ];

        foreach ($modelClasses as $modelClass => $mapping) {

            foreach ($nonLunarTables as $table => $column) {
                if (! Schema::hasTable($table)) {
                    continue;
                }
                \Illuminate\Support\Facades\DB::table($table)
                    ->where($column, '=', $modelClass)
                    ->update([
                        $column => $mapping,
                    ]);
            }

            foreach ($tables as $tableName => $columns) {
                $table = \Illuminate\Support\Facades\DB::table(
                    $this->prefix.$tableName
                );

                foreach ($columns as $column) {
                    $table->where($column, '=', $modelClass)->update([
                        $column => $mapping,
                    ]);
                }
            }
        }
    }

    public function down()
    {
        // ...
    }
}

```


---

**File:** `./database/migrations/2024_03_26_100000_create_brand_collection_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'brand_collection', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained($this->prefix.'brands');
            $table->foreignId('collection_id')->constrained($this->prefix.'collections');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'brand_collection');
    }
};

```


---

**File:** `./database/migrations/2024_04_23_100000_add_soft_deletes_to_carts_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'carts', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'carts', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
};

```


---

**File:** `./database/migrations/2024_05_25_100000_update_collection_group_handle_unique.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'collection_groups', function (Blueprint $table) {
            $table->dropIndex(['handle']);
        });

        Schema::table($this->prefix.'collection_groups', function (Blueprint $table) {
            $table->unique(['handle']);
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'collection_groups', function (Blueprint $table) {
            $table->dropUnique(['handle']);
        });

        Schema::table($this->prefix.'collection_groups', function (Blueprint $table) {
            $table->index(['handle']);
        });
    }
};

```


---

**File:** `./database/migrations/2024_07_23_100000_add_fingerprint_to_orders_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'orders', function (Blueprint $table) {
            $table->string('fingerprint')->nullable()->index();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'orders', function (Blueprint $table) {
            $table->dropIndex(['fingerprint']);
        });
        Schema::table($this->prefix.'orders', function (Blueprint $table) {
            $table->dropColumn('fingerprint');
        });
    }
};

```


---

**File:** `./database/migrations/2025_02_07_100000_create_customer_discount_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->prefix.'customer_discount', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_id')->constrained($this->prefix.'discounts');
            $table->foreignId('customer_id')->constrained($this->prefix.'customers');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->prefix.'customer_discount');
    }
};

```


---

**File:** `./database/migrations/2025_02_14_100000_add_tax_identifier_to_addresses_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'addresses', function (Blueprint $table) {
            $table->string('tax_identifier')->after('company_name')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'addresses', function (Blueprint $table) {
            $table->dropColumn('tax_identifier');
        });
    }
};

```


---

**File:** `./database/migrations/2025_02_14_100010_add_tax_identifier_to_order_addresses_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'order_addresses', function (Blueprint $table) {
            $table->string('tax_identifier')->after('company_name')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'order_addresses', function (Blueprint $table) {
            $table->dropColumn('tax_identifier');
        });
    }
};

```


---

**File:** `./database/migrations/2025_02_14_100020_add_tax_identifier_to_cart_addresses_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'cart_addresses', function (Blueprint $table) {
            $table->string('tax_identifier')->after('company_name')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'cart_addresses', function (Blueprint $table) {
            $table->dropColumn('tax_identifier');
        });
    }
};

```


---

**File:** `./database/migrations/2025_02_14_100030_rename_vat_no_at_customers_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'customers', function (Blueprint $table) {
            $table->renameColumn('vat_no', 'tax_identifier');
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'customers', function (Blueprint $table) {
            $table->renameColumn('tax_identifier', 'vat_no');
        });
    }
};

```


---

**File:** `./database/migrations/2025_06_18_100000_add_sync_prices_to_currencies_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'currencies', function (Blueprint $table) {
            $table->boolean('sync_prices')->after('default')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'currencies', function (Blueprint $table) {
            $table->dropColumn('sync_prices');
        });
    }
};

```


---

**File:** `./database/migrations/2025_06_18_100000_rename_discount_purchasables_table.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename($this->prefix.'discount_purchasables', $this->prefix.'discountables');

        Schema::table($this->prefix.'discountables', function (Blueprint $table) {
            $table->renameColumn('purchasable_id', 'discountable_id');
        });

        Schema::table($this->prefix.'discountables', function (Blueprint $table) {
            $table->renameColumn('purchasable_type', 'discountable_type');
        });
    }

    public function down(): void
    {
        Schema::rename($this->prefix.'discountables', $this->prefix.'discount_purchasables');

        Schema::table($this->prefix.'discount_purchasables', function (Blueprint $table) {
            $table->renameColumn('discountable_id', 'purchasable_id');
        });

        Schema::table($this->prefix.'discount_purchasables', function (Blueprint $table) {
            $table->renameColumn('discountable_type', 'purchasable_type');
        });
    }
};

```


---

**File:** `./database/migrations/2025_08_05_083800_update_delivery_instructions_columns.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table($this->prefix.'addresses', function (Blueprint $table) {
            $table->string('delivery_instructions', 1000)->nullable()->change();
        });

        Schema::table($this->prefix.'cart_addresses', function (Blueprint $table) {
            $table->string('delivery_instructions', 1000)->nullable()->change();
        });

        Schema::table($this->prefix.'order_addresses', function (Blueprint $table) {
            $table->string('delivery_instructions', 1000)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table($this->prefix.'addresses', function (Blueprint $table) {
            $table->string('delivery_instructions')->nullable()->change();
        });

        Schema::table($this->prefix.'cart_addresses', function (Blueprint $table) {
            $table->string('delivery_instructions')->nullable()->change();
        });

        Schema::table($this->prefix.'order_addresses', function (Blueprint $table) {
            $table->string('delivery_instructions')->nullable()->change();
        });
    }
};

```


---

**File:** `./database/migrations/2025_08_14_164000_switch_to_jsonb.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    /**
     * The list of tables and JSON columns to update.
     */
    private $columnsToUpdate = [
        'activity_log' => [
            ['name' => 'properties', 'nullable' => true],
        ],
        'addresses' => [
            ['name' => 'meta', 'nullable' => true],
        ],
        'attribute_groups' => [
            ['name' => 'name', 'nullable' => false],
        ],
        'attributes' => [
            ['name' => 'configuration', 'nullable' => false],
            ['name' => 'description', 'nullable' => true],
            ['name' => 'name', 'nullable' => false],
        ],
        'brands' => [
            ['name' => 'attribute_data', 'nullable' => true],
        ],
        'cart_addresses' => [
            ['name' => 'meta', 'nullable' => true],
        ],
        'cart_lines' => [
            ['name' => 'meta', 'nullable' => true],
        ],
        'carts' => [
            ['name' => 'meta', 'nullable' => true],
        ],
        'collections' => [
            ['name' => 'attribute_data', 'nullable' => true],
        ],
        'customer_groups' => [
            ['name' => 'attribute_data', 'nullable' => true],
        ],
        'customers' => [
            ['name' => 'attribute_data', 'nullable' => true],
            ['name' => 'meta', 'nullable' => true],
        ],
        'discounts' => [
            ['name' => 'data', 'nullable' => true],
        ],
        'order_addresses' => [
            ['name' => 'meta', 'nullable' => true],
        ],
        'order_lines' => [
            ['name' => 'meta', 'nullable' => true],
            ['name' => 'tax_breakdown', 'nullable' => false],
        ],
        'orders' => [
            ['name' => 'discount_breakdown', 'nullable' => true],
            ['name' => 'meta', 'nullable' => true],
            ['name' => 'shipping_breakdown', 'nullable' => true],
            ['name' => 'tax_breakdown', 'nullable' => false],
        ],
        'product_option_values' => [
            ['name' => 'name', 'nullable' => false],
        ],
        'product_options' => [
            ['name' => 'label', 'nullable' => true],
            ['name' => 'name', 'nullable' => false],
        ],
        'product_variants' => [
            ['name' => 'attribute_data', 'nullable' => true],
        ],
        'products' => [
            ['name' => 'attribute_data', 'nullable' => true],
        ],
        'transactions' => [
            ['name' => 'meta', 'nullable' => true],
        ],
        'media' => [
            ['name' => 'custom_properties', 'nullable' => false],
            ['name' => 'generated_conversions', 'nullable' => false],
            ['name' => 'manipulations', 'nullable' => false],
            ['name' => 'responsive_images', 'nullable' => false],
        ],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Only run for PostgreSQL - MySQL has no change and SQLite will error when trying to change
        if (DB::getDriverName() !== 'pgsql') {
            return;
        }

        foreach ($this->columnsToUpdate as $table => $columns) {
            $fullTableName = $this->getTableName($table);

            Schema::table($fullTableName, function (Blueprint $tableBlueprint) use ($columns) {
                foreach ($columns as $column) {
                    $tableBlueprint->jsonb($column['name'])
                        ->nullable($column['nullable'])
                        ->change();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Only run for PostgreSQL
        if (DB::getDriverName() !== 'pgsql') {
            return;
        }

        foreach ($this->columnsToUpdate as $table => $columns) {
            $fullTableName = $this->getTableName($table);

            Schema::table($fullTableName, function (Blueprint $tableBlueprint) use ($columns) {
                foreach ($columns as $column) {
                    $tableBlueprint->json($column['name'])
                        ->nullable($column['nullable'])
                        ->change();
                }
            });
        }
    }

    /**
     * Get the full table name with appropriate prefix.
     */
    private function getTableName(string $table): string
    {
        return in_array($table, ['activity_log', 'media']) ? $table : $this->prefix.$table;
    }
};

```


---

**File:** `./database/migrations/2025_10_29_084000_add_missing_indexes_to_tables.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    /**
     * The list of tables and columns to index.
     */
    private $columnsToUpdate = [
        'channelables' => [
            'enabled',
            'starts_at',
        ],
        'products' => [
            'deleted_at',
        ],
        'product_variants' => [
            'deleted_at',
        ],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach ($this->columnsToUpdate as $table => $columns) {
            $fullTableName = $this->getTableName($table);

            Schema::table($fullTableName, function (Blueprint $tableBlueprint) use ($columns) {
                foreach ($columns as $column) {
                    $tableBlueprint->index($column);
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach ($this->columnsToUpdate as $table => $columns) {
            $fullTableName = $this->getTableName($table);

            Schema::table($fullTableName, function (Blueprint $tableBlueprint) use ($columns) {
                foreach ($columns as $column) {
                    $tableBlueprint->dropIndex([$column]);
                }
            });
        }
    }

    /**
     * Get the full table name with appropriate prefix.
     */
    private function getTableName(string $table): string
    {
        return in_array($table, ['activity_log', 'media']) ? $table : $this->prefix.$table;
    }
};

```


---

**File:** `./database/migrations/2025_11_12_005200_add_meta_to_product_options.php`

```php
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Lunar\Base\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table($this->prefix.'product_options', function (Blueprint $table) {
            $table->jsonb('meta')->nullable()->after('shared');
        });

        Schema::table($this->prefix.'product_option_values', function (Blueprint $table) {
            $table->jsonb('meta')->nullable()->after('position');
        });
    }

    public function down(): void
    {
        Schema::table($this->prefix.'product_options', function (Blueprint $table) {
            $table->dropColumn('meta');
        });

        Schema::table($this->prefix.'product_option_values', function (Blueprint $table) {
            $table->dropColumn('meta');
        });
    }
};

```


---

**File:** `./database/migrations/2026_02_08_141241_create_permission_tables.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $teams = config('permission.teams');
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');
        $pivotRole = $columnNames['role_pivot_key'] ?? 'role_id';
        $pivotPermission = $columnNames['permission_pivot_key'] ?? 'permission_id';

        throw_if(empty($tableNames), Exception::class, 'Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        throw_if($teams && empty($columnNames['team_foreign_key'] ?? null), Exception::class, 'Error: team_foreign_key on config/permission.php not loaded. Run [php artisan config:clear] and try again.');

        Schema::create($tableNames['permissions'], static function (Blueprint $table) {
            // $table->engine('InnoDB');
            $table->bigIncrements('id'); // permission id
            $table->string('name');       // For MyISAM use string('name', 225); // (or 166 for InnoDB with Redundant/Compact row format)
            $table->string('guard_name'); // For MyISAM use string('guard_name', 25);
            $table->timestamps();

            $table->unique(['name', 'guard_name']);
        });

        Schema::create($tableNames['roles'], static function (Blueprint $table) use ($teams, $columnNames) {
            // $table->engine('InnoDB');
            $table->bigIncrements('id'); // role id
            if ($teams || config('permission.testing')) { // permission.testing is a fix for sqlite testing
                $table->unsignedBigInteger($columnNames['team_foreign_key'])->nullable();
                $table->index($columnNames['team_foreign_key'], 'roles_team_foreign_key_index');
            }
            $table->string('name');       // For MyISAM use string('name', 225); // (or 166 for InnoDB with Redundant/Compact row format)
            $table->string('guard_name'); // For MyISAM use string('guard_name', 25);
            $table->timestamps();
            if ($teams || config('permission.testing')) {
                $table->unique([$columnNames['team_foreign_key'], 'name', 'guard_name']);
            } else {
                $table->unique(['name', 'guard_name']);
            }
        });

        Schema::create($tableNames['model_has_permissions'], static function (Blueprint $table) use ($tableNames, $columnNames, $pivotPermission, $teams) {
            $table->unsignedBigInteger($pivotPermission);

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_permissions_model_id_model_type_index');

            $table->foreign($pivotPermission)
                ->references('id') // permission id
                ->on($tableNames['permissions'])
                ->onDelete('cascade');
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_permissions_team_foreign_key_index');

                $table->primary([$columnNames['team_foreign_key'], $pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
            } else {
                $table->primary([$pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
            }

        });

        Schema::create($tableNames['model_has_roles'], static function (Blueprint $table) use ($tableNames, $columnNames, $pivotRole, $teams) {
            $table->unsignedBigInteger($pivotRole);

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_roles_model_id_model_type_index');

            $table->foreign($pivotRole)
                ->references('id') // role id
                ->on($tableNames['roles'])
                ->onDelete('cascade');
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_roles_team_foreign_key_index');

                $table->primary([$columnNames['team_foreign_key'], $pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
            } else {
                $table->primary([$pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
            }
        });

        Schema::create($tableNames['role_has_permissions'], static function (Blueprint $table) use ($tableNames, $pivotRole, $pivotPermission) {
            $table->unsignedBigInteger($pivotPermission);
            $table->unsignedBigInteger($pivotRole);

            $table->foreign($pivotPermission)
                ->references('id') // permission id
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign($pivotRole)
                ->references('id') // role id
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary([$pivotPermission, $pivotRole], 'role_has_permissions_permission_id_role_id_primary');
        });

        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tableNames = config('permission.table_names');

        throw_if(empty($tableNames), Exception::class, 'Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
};

```


---

**File:** `./database/migrations/2026_02_08_141242_add_two_factor_authentication_columns.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('two_factor_secret')
                ->after('password')
                ->nullable();

            $table->text('two_factor_recovery_codes')
                ->after('two_factor_secret')
                ->nullable();

            $table->timestamp('two_factor_confirmed_at')
                ->after('two_factor_recovery_codes')
                ->nullable();
        });
    }

   public function down(): void
   {
       Schema::table('users', function (Blueprint $table) {
           $table->dropColumn([
               'two_factor_secret',
               'two_factor_recovery_codes',
               'two_factor_confirmed_at',
           ]);
       });
   }
};

```


---

**File:** `./database/migrations/2026_02_08_141242_create_activity_log_table.php`

```php
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogTable extends Migration
{
    public function up()
    {
        Schema::connection(config('activitylog.database_connection'))->create(config('activitylog.table_name'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('log_name')->nullable();
            $table->text('description');
            $table->nullableMorphs('subject', 'subject');
            $table->nullableMorphs('causer', 'causer');
            $table->json('properties')->nullable();
            $table->timestamps();
            $table->index('log_name');
        });
    }

    public function down()
    {
        Schema::connection(config('activitylog.database_connection'))->dropIfExists(config('activitylog.table_name'));
    }
}

```


---

**File:** `./database/migrations/2026_02_08_141242_create_imports_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('imports', function (Blueprint $table) {
            $table->id();
            $table->timestamp('completed_at')->nullable();
            $table->string('file_name');
            $table->string('file_path');
            $table->string('importer');
            $table->unsignedInteger('processed_rows')->default(0);
            $table->unsignedInteger('total_rows');
            $table->unsignedInteger('successful_rows')->default(0);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imports');
    }
};

```


---

**File:** `./database/migrations/2026_02_08_141242_create_media_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();

            $table->morphs('model');
            $table->uuid()->nullable()->unique();
            $table->string('collection_name');
            $table->string('name');
            $table->string('file_name');
            $table->string('mime_type')->nullable();
            $table->string('disk');
            $table->string('conversions_disk')->nullable();
            $table->unsignedBigInteger('size');
            $table->json('manipulations');
            $table->json('custom_properties');
            $table->json('generated_conversions');
            $table->json('responsive_images');
            $table->unsignedInteger('order_column')->nullable()->index();

            $table->nullableTimestamps();
        });
    }
};

```


---

**File:** `./database/migrations/2026_02_08_141242_create_passkeys_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\LaravelPasskeys\Support\Config;

return new class extends Migration
{
    public function up()
    {
        $authenticatableClass = Config::getAuthenticatableModel();

        $authenticatableTableName = (new $authenticatableClass)->getTable();

        Schema::create('passkeys', function (Blueprint $table) use ($authenticatableTableName,$authenticatableClass) {
            $table->id();

            $table
                ->foreignIdFor($authenticatableClass, 'authenticatable_id')
                ->constrained(table: $authenticatableTableName, indexName: 'passkeys_authenticatable_fk')
                ->cascadeOnDelete();

            $table->text('name');
            $table->text('credential_id');
            $table->json('data');

            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();
        });
    }
};

```


---

**File:** `./database/migrations/2026_02_08_141243_add_event_column_to_activity_log_table.php`

```php
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEventColumnToActivityLogTable extends Migration
{
    public function up()
    {
        Schema::connection(config('activitylog.database_connection'))->table(config('activitylog.table_name'), function (Blueprint $table) {
            $table->string('event')->nullable()->after('subject_type');
        });
    }

    public function down()
    {
        Schema::connection(config('activitylog.database_connection'))->table(config('activitylog.table_name'), function (Blueprint $table) {
            $table->dropColumn('event');
        });
    }
}

```


---

**File:** `./database/migrations/2026_02_08_141243_create_exports_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exports', function (Blueprint $table) {
            $table->id();
            $table->timestamp('completed_at')->nullable();
            $table->string('file_disk');
            $table->string('file_name')->nullable();
            $table->string('exporter');
            $table->unsignedInteger('processed_rows')->default(0);
            $table->unsignedInteger('total_rows');
            $table->unsignedInteger('successful_rows')->default(0);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exports');
    }
};

```


---

**File:** `./database/migrations/2026_02_08_141244_add_batch_uuid_column_to_activity_log_table.php`

```php
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBatchUuidColumnToActivityLogTable extends Migration
{
    public function up()
    {
        Schema::connection(config('activitylog.database_connection'))->table(config('activitylog.table_name'), function (Blueprint $table) {
            $table->uuid('batch_uuid')->nullable()->after('properties');
        });
    }

    public function down()
    {
        Schema::connection(config('activitylog.database_connection'))->table(config('activitylog.table_name'), function (Blueprint $table) {
            $table->dropColumn('batch_uuid');
        });
    }
}

```


---

**File:** `./database/migrations/2026_02_08_141244_create_failed_import_rows_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('failed_import_rows', function (Blueprint $table) {
            $table->id();
            $table->json('data');
            $table->foreignId('import_id')->constrained()->cascadeOnDelete();
            $table->text('validation_error')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('failed_import_rows');
    }
};

```

### Seeders


---

**File:** `./database/seeders/AbstractSeeder.php`

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

abstract class AbstractSeeder extends Seeder
{
    protected function getSeedData($file): Collection
    {
        return collect(json_decode(
            File::get(
                base_path("database/seeders/data/{$file}.json")
            )
        ));
    }
}

```


---

**File:** `./database/seeders/AttributeSeeder.php`

```php
<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Lunar\Models\Attribute;
use Lunar\Models\AttributeGroup;

class AttributeSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     */
    public function run(): void
    {
        $attributes = $this->getSeedData('attributes');

        $attributeGroup = AttributeGroup::first();

        DB::transaction(function () use ($attributes, $attributeGroup) {
            foreach ($attributes as $attribute) {
                Attribute::create([
                    'attribute_group_id' => $attributeGroup->id,
                    'attribute_type' => $attribute->attribute_type,
                    'handle' => $attribute->handle,
                    'section' => 'main',
                    'type' => $attribute->type,
                    'required' => false,
                    'searchable' => true,
                    'filterable' => false,
                    'system' => false,
                    'position' => $attributeGroup->attributes()->count() + 1,
                    'name' => [
                        'en' => $attribute->name,
                    ],
                    'description' => [
                        'en' => $attribute->name,
                    ],
                    'configuration' => (array) $attribute->configuration,
                ]);
            }
        });
    }
}

```


---

**File:** `./database/seeders/CollectionSeeder.php`

```php
<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Lunar\FieldTypes\Text;
use Lunar\FieldTypes\TranslatedText;
use Lunar\Models\Collection;
use Lunar\Models\CollectionGroup;

class CollectionSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     */
    public function run(): void
    {
        $collections = $this->getSeedData('collections');

        $collectionGroup = CollectionGroup::first();

        DB::transaction(function () use ($collections, $collectionGroup) {
            foreach ($collections as $collection) {
                Collection::create([
                    'collection_group_id' => $collectionGroup->id,
                    'attribute_data' => [
                        'name' => new TranslatedText([
                            'en' => new Text($collection->name),
                        ]),
                        'description' => new TranslatedText([
                            'en' => new Text($collection->description),
                        ]),
                    ],
                ]);
            }
        });
    }
}

```


---

**File:** `./database/seeders/CustomerSeeder.php`

```php
<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Lunar\Models\Address;
use Lunar\Models\Customer;

class CustomerSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     */
    public function run(): void
    {
        DB::transaction(function () {
            $faker = Factory::create();
            $customers = Customer::factory(100)->create();

            foreach ($customers as $customer) {
                for ($i = 0; $i < $faker->numberBetween(1, 10); $i++) {
                    $user = User::factory()->create();

                    $customer->users()->attach($user);
                }

                Address::factory()->create([
                    'shipping_default' => true,
                    'country_id' => 235,
                    'customer_id' => $customer->id,
                ]);

                Address::factory()->create([
                    'shipping_default' => false,
                    'country_id' => 235,
                    'customer_id' => $customer->id,
                ]);

                Address::factory()->create([
                    'shipping_default' => false,
                    'billing_default' => true,
                    'country_id' => 235,
                    'customer_id' => $customer->id,
                ]);

                Address::factory()->create([
                    'shipping_default' => false,
                    'billing_default' => false,
                    'country_id' => 235,
                    'customer_id' => $customer->id,
                ]);
            }
        });
    }
}

```


---

**File:** `./database/seeders/DatabaseSeeder.php`

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     */
    public function run(): void
    {
        $this->call(CollectionSeeder::class);
        $this->call(AttributeSeeder::class);
        $this->call(TaxSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(ShippingSeeder::class);
        $this->call(OrderSeeder::class);
    }
}

```


---

**File:** `./database/seeders/OrderSeeder.php`

```php
<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Lunar\Base\OrderReferenceGenerator;
use Lunar\Base\ValueObjects\Cart\TaxBreakdown;
use Lunar\Base\ValueObjects\Cart\TaxBreakdownAmount;
use Lunar\DataTypes\Price;
use Lunar\Facades\Pricing;
use Lunar\Models\Channel;
use Lunar\Models\Currency;
use Lunar\Models\Order;
use Lunar\Models\OrderAddress;
use Lunar\Models\ProductVariant;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     */
    public function run(): void
    {
        DB::transaction(function () {
            $variants = ProductVariant::get();
            $users = User::get();
            $faker = Factory::create();
            $channel = Channel::getDefault();
            $currency = Currency::getDefault();

            $cardTypes = ['visa', 'mastercard'];

            for ($i = 0; $i < 201; $i++) {
                $generator = app(OrderReferenceGenerator::class);

                $itemModels = $variants->shuffle()->take($faker->numberBetween(1, 15));

                $lines = collect();

                foreach ($itemModels as $variant) {
                    $quantity = $faker->numberBetween(1, 10);

                    $pricing = Pricing::for($variant, $quantity)->get();
                    $price = $pricing->matched->price->value;
                    $subTotal = $price * $quantity;
                    $tax = (int) ($subTotal * .2);
                    $options = $variant->values->map(fn ($value) => $value->translate('name'));

                    $lines->push([
                        'quantity' => $quantity,
                        'purchasable_type' => (new ProductVariant)->getMorphClass(),
                        'purchasable_id' => $variant->id,
                        'type' => 'physical',
                        'description' => $variant->product->translateAttribute('name'),
                        'option' => $options->join(', '),
                        'identifier' => $variant->sku,
                        'unit_price' => $price,
                        'unit_quantity' => $variant->unit_quantity,
                        'sub_total' => $subTotal,
                        'discount_total' => 0,
                        'tax_total' => $tax,
                        'total' => $subTotal + $tax,
                        'tax_breakdown' => new TaxBreakdown(collect([
                            new TaxBreakdownAmount(
                                price: new Price($tax, $currency, 1),
                                identifier: 'VAT',
                                description: 'VAT',
                                percentage: 20,
                            ),
                        ])),
                    ]);
                }

                // Is this for a user?
                $hasUser = $faker->boolean(75);

                $order = [
                    'channel_id' => $channel->id,
                    'status' => 'payment-received',
                    'sub_total' => $lines->sum('sub_total'),
                    'reference' => null,
                    'tax_total' => $lines->sum('tax_total'),
                    'total' => $lines->sum('total'),
                    'currency_code' => $currency->code,
                    'placed_at' => $faker->dateTimeBetween('-1 year'),
                    'compare_currency_code' => $currency->code,
                    'meta' => [],
                    'tax_breakdown' => new TaxBreakdown(collect([
                        new TaxBreakdownAmount(
                            price: new Price($lines->sum('tax_total'), $currency, 1),
                            identifier: 'VAT',
                            description: 'VAT',
                            percentage: 20,
                        ),
                    ])),
                ];

                if ($hasUser) {
                    $user = $users->shuffle()->first();

                    $order['customer_id'] = $user->customers->first()?->id;
                    $order['user_id'] = $user->id;
                }

                $orderModel = Order::factory()->create($order);

                $orderModel->reference = $generator->generate($orderModel);
                $orderModel->save();

                // Shipping / Billing address
                $shipping = OrderAddress::factory()->create([
                    'order_id' => $orderModel->id,
                    'type' => 'shipping',
                    'country_id' => 235, // UK
                ]);

                if ($faker->boolean()) {
                    $shippingAdd = $shipping->toArray();
                    unset($shippingAdd['id']);
                    $shippingAdd['type'] = 'billing';
                    OrderAddress::factory()->create($shippingAdd);
                } else {
                    OrderAddress::factory()->create([
                        'order_id' => $orderModel->id,
                        'type' => 'billing',
                        'country_id' => 235, // UK
                    ]);
                }

                $orderModel->lines()->createMany($lines->toArray());
            }
        });
    }
}

```


---

**File:** `./database/seeders/ProductSeeder.php`

```php
<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Lunar\Admin\Actions\Products\MapVariantsToProductOptions;
use Lunar\FieldTypes\ListField;
use Lunar\FieldTypes\Text;
use Lunar\FieldTypes\TranslatedText;
use Lunar\Models\Attribute;
use Lunar\Models\Brand;
use Lunar\Models\Collection;
use Lunar\Models\Currency;
use Lunar\Models\Language;
use Lunar\Models\Price;
use Lunar\Models\Product;
use Lunar\Models\ProductOption;
use Lunar\Models\ProductOptionValue;
use Lunar\Models\ProductType;
use Lunar\Models\ProductVariant;
use Lunar\Models\TaxClass;
use App\Jobs\GenerateVariants;

class ProductSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $products = $this->getSeedData('products');

        $attributes = Attribute::get();

        $productType = ProductType::first();

        $taxClass = TaxClass::getDefault();

        $currency = Currency::getDefault();

        $collections = Collection::get();

        $language = Language::getDefault();

        DB::transaction(function () use ($products, $attributes, $productType, $taxClass, $currency, $collections) {
            $products->each(function ($product) use ($attributes, $productType, $taxClass, $currency, $collections) {
                $attributeData = [];

                foreach ($product->attributes as $attributeHandle => $value) {
                    $attribute = $attributes->first(fn ($att) => $att->handle == $attributeHandle);

                    if ($attribute->type == TranslatedText::class) {
                        $attributeData[$attributeHandle] = new TranslatedText([
                            'en' => new Text($value),
                        ]);

                        continue;
                    }

                    if ($attribute->type == ListField::class) {
                        $attributeData[$attributeHandle] = new ListField((array) $value);
                    }
                }

                $brand = Brand::firstOrCreate([
                    'name' => $product->brand,
                ]);

                $productModel = Product::create([
                    'attribute_data' => $attributeData,
                    'product_type_id' => $productType->id,
                    'status' => 'published',
                    'brand_id' => $brand->id,
                ]);

                $variant = ProductVariant::create([
                    'product_id' => $productModel->id,
                    'purchasable' => 'always',
                    'shippable' => true,
                    'backorder' => 0,
                    'sku' => $product->sku,
                    'tax_class_id' => $taxClass->id,
                    'stock' => 500,
                ]);

                if (!count($product->options ?? [])) {
                    Price::create([
                        'customer_group_id' => null,
                        'currency_id' => $currency->id,
                        'priceable_type' => (new ProductVariant)->getMorphClass(),
                        'priceable_id' => $variant->id,
                        'price' => $product->price,
                        'min_quantity' => 1,
                    ]);
                }

                $media = $productModel->addMedia(
                    base_path("database/seeders/data/images/{$product->image}")
                )->preservingOriginal()->toMediaCollection('images');

                $media->setCustomProperty('primary', true);
                $media->save();

                $collections->each(function ($coll) use ($product, $productModel) {
                    if (in_array(strtolower($coll->translateAttribute('name')), $product->collections)) {
                        $coll->products()->attach($productModel->id);
                    }
                });

                if (! count($product->options ?? [])) {
                    return;
                }

                $options = ProductOption::get();

                $optionValues = ProductOptionValue::get();

                $optionValueMapping = collect($product->options)->mapWithKeys(
                    function ($option) {
                        return [
                            $option->name => $option->values
                        ];
                    }
                )->toArray();

                $optionIds = [];

                foreach ($product->options ?? [] as $optionIndex => $option) {
                    // Do we have this option already?
                    $optionModel = $options->first(fn ($opt) => $option->name == $opt->translate('name'));

                    if (! $optionModel) {
                        $optionModel = ProductOption::create([
                            'name' => [
                                'en' => $option->name,
                            ],
                            'label' => [
                                'en' => $option->name,
                            ],
                            'shared' => $option->shared,
                            'handle' => Str::slug($option->name),
                        ]);
                    }

                    $optionIds[$optionModel->id] = [
                        'position' => $optionIndex + 1
                    ];

                    foreach ($option->values as $value) {
                        $valueModel = $optionValues->first(fn ($val) => $value == $val->translate('name'));

                        if (! $valueModel) {
                            ProductOptionValue::create([
                                'product_option_id' => $optionModel->id,
                                'position' => $optionIndex,

                                'name' => [
                                    'en' => $value,
                                ],
                            ]);
                        }
                    }
                }

                if (! count($product->options ?? [])) {
                    return;
                }

                $productModel->productOptions()->sync($optionIds);

                $variants = collect([$variant])->map(function ($variant) use ($product) {
                    return [
                        'id' => $variant->id,
                        'sku' => $variant->sku,
                        'price' => $product->price,
                        'values' => [],
                    ];
                })->toArray();

                $variants = MapVariantsToProductOptions::map($optionValueMapping, $variants, true);

                foreach ($variants as $variant) {
                    if (!$variant['variant_id']) {
                        $variantModel = ProductVariant::create([
                            'product_id' => $productModel->id,
                            'purchasable' => 'always',
                            'shippable' => true,
                            'backorder' => 0,
                            'sku' => $variant['sku'],
                            'tax_class_id' => $taxClass->id,
                            'stock' => 500,
                        ]);
                        $variant['variant_id'] = $variantModel->id;
                    } else {
                        $variantModel = ProductVariant::find($variant['variant_id']);
                    }

                    Price::create([
                        'customer_group_id' => null,
                        'currency_id' => $currency->id,
                        'priceable_type' => (new ProductVariant)->getMorphClass(),
                        'priceable_id' => $variant['variant_id'],
                        'price' => $variant['price'],
                        'min_quantity' => 1,
                    ]);

                    $valueIds = ProductOptionValue::get()->filter(function ($option) use ($variant) {
                        return in_array($option->translate('name'), $variant['values']);
                    })->pluck('id');

                    $variantModel->values()->sync($valueIds);
                }
            });
        });
    }
}

```


---

**File:** `./database/seeders/ShippingSeeder.php`

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Lunar\Models\Country;
use Lunar\Models\Currency;
use Lunar\Models\Price;
use Lunar\Shipping\Models\ShippingMethod;
use Lunar\Shipping\Models\ShippingRate;
use Lunar\Shipping\Models\ShippingZone;
use Lunar\Shipping\Models\ShippingZonePostcode;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currency = Currency::getDefault();

        $standardShipping = ShippingMethod::create([
            'name' => 'Standard Shipping',
            'code' => 'STNDRD',
            'enabled' => true,
            'driver' => 'ship-by',
            'data' => [
                'charge_by' => 'cart_total',
            ]
        ]);

        $ukShippingZone = ShippingZone::create([
            'name' => 'UK',
            'type' => 'countries',
        ]);

        $ukShippingRate = ShippingRate::create([
            'shipping_zone_id' => $ukShippingZone->id,
            'shipping_method_id' => $standardShipping->id,
            'enabled' => true,
        ]);

        $ukShippingZone->countries()->sync(
            Country::where('iso3', '=', 'GBR')->first()->id,
        );

        Price::create([
            'priceable_type' => (new ShippingRate)->getMorphClass(),
            'priceable_id' => $ukShippingRate->id,
            'price' => 1000,
            'min_quantity' => 1,
            'currency_id' => $currency->id,
        ]);

        // Free shipping on £100 or over orders
        Price::create([
            'priceable_type' => (new ShippingRate)->getMorphClass(),
            'priceable_id' => $ukShippingRate->id,
            'price' => 0,
            'min_quantity' => 10000,
            'currency_id' => $currency->id,
        ]);

        // US Shipping

        $usShipping = ShippingMethod::create([
            'name' => 'US Shipping',
            'code' => 'USA',
            'enabled' => true,
            'driver' => 'ship-by',
            'data' => [
                'charge_by' => 'cart_total',
            ]
        ]);

        $usShippingZone = ShippingZone::create([
            'name' => 'America',
            'type' => 'countries',
        ]);

        $usShippingRate = ShippingRate::create([
            'shipping_zone_id' => $usShippingZone->id,
            'shipping_method_id' => $usShipping->id,
            'enabled' => true,
        ]);

        $usShippingZone->countries()->sync(
            Country::where('iso3', '=', 'USA')->first()->id,
        );

        Price::create([
            'priceable_type' => (new ShippingRate)->getMorphClass(),
            'priceable_id' => $usShippingRate->id,
            'price' => 5000,
            'min_quantity' => 1,
            'currency_id' => $currency->id,
        ]);

        // European shipping

        $euroShipping = ShippingMethod::create([
            'name' => 'Europe Delivery',
            'code' => 'EURO',
            'enabled' => true,
            'driver' => 'ship-by',
        ]);

        $euroShippingZone = ShippingZone::create([
            'name' => 'Europe',
            'type' => 'countries',
        ]);

        $euroShippingRate = ShippingRate::create([
            'shipping_zone_id' => $euroShippingZone->id,
            'shipping_method_id' => $euroShipping->id,
            'enabled' => true,
        ]);

        $euroShippingZone->countries()->sync(
            Country::whereIn('iso3', [
                'AUT',
                'BEL',
                'BGR',
                'HRV',
                'CYP',
                'CZE',
                'DNK',
                'EST',
                'FIN',
                'FRA',
                'DEU',
                'GRC',
                'HUN',
                'IRL',
                'ITA',
                'LVA',
                'LTU',
                'LUX',
                'MLT',
                'NLD',
                'POL',
                'ROU',
                'SVK',
                'ESP',
                'SWE',
            ])->pluck('id'),
        );

        Price::create([
            'priceable_type' =>(new ShippingRate)->getMorphClass(),
            'priceable_id' => $euroShippingRate->id,
            'price' => 2000,
            'min_quantity' => 1,
            'currency_id' => $currency->id,
        ]);

    }
}

```


---

**File:** `./database/seeders/TaxSeeder.php`

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Lunar\Models\Country;
use Lunar\Models\TaxClass;
use Lunar\Models\TaxRate;
use Lunar\Models\TaxZone;
use Lunar\Models\TaxZoneCountry;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     */
    public function run(): void
    {
        $taxClass = TaxClass::first();

        $ukCountry = Country::firstWhere('iso3', 'GBR');

        $ukTaxZone = TaxZone::factory()->create([
            'name' => 'UK',
            'active' => true,
            'default' => true,
            'zone_type' => 'country',
        ]);

        TaxZoneCountry::factory()->create([
            'country_id' => $ukCountry->id,
            'tax_zone_id' => $ukTaxZone->id,
        ]);

        $ukRate = TaxRate::factory()->create([
            'name' => 'VAT',
            'tax_zone_id' => $ukTaxZone->id,
            'priority' => 1,
        ]);

        $ukRate->taxRateAmounts()->createMany([
            [
                'percentage' => 20,
                'tax_class_id' => $taxClass->id,
            ],
        ]);
    }
}

```

### Factories


---

**File:** `./database/factories/UserFactory.php`

```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

```

### Configuration Files


---

**File:** `./config/activitylog.php`

```php
<?php

return [

    /*
     * If set to false, no activities will be saved to the database.
     */
    'enabled' => env('ACTIVITY_LOGGER_ENABLED', true),

    /*
     * When the clean-command is executed, all recording activities older than
     * the number of days specified here will be deleted.
     */
    'delete_records_older_than_days' => 365,

    /*
     * If no log name is passed to the activity() helper
     * we use this default log name.
     */
    'default_log_name' => 'default',

    /*
     * You can specify an auth driver here that gets user models.
     * If this is null we'll use the current Laravel auth driver.
     */
    'default_auth_driver' => null,

    /*
     * If set to true, the subject returns soft deleted models.
     */
    'subject_returns_soft_deleted_models' => false,

    /*
     * This model will be used to log activity.
     * It should implement the Spatie\Activitylog\Contracts\Activity interface
     * and extend Illuminate\Database\Eloquent\Model.
     */
    'activity_model' => \Spatie\Activitylog\Models\Activity::class,

    /*
     * This is the name of the table that will be created by the migration and
     * used by the Activity model shipped with this package.
     */
    'table_name' => env('ACTIVITY_LOGGER_TABLE_NAME', 'activity_log'),

    /*
     * This is the database connection that will be used by the migration and
     * the Activity model shipped with this package. In case it's not set
     * Laravel's database.default will be used instead.
     */
    'database_connection' => env('ACTIVITY_LOGGER_DB_CONNECTION'),
];

```


---

**File:** `./config/app.php`

```php
<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => 'file',
        // 'store'  => 'redis',
    ],

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
    ])->toArray(),

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => Facade::defaultAliases()->merge([
        // ...
    ])->toArray(),

];

```


---

**File:** `./config/auth.php`

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that each reset token will be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

];

```


---

**File:** `./config/blade-heroicons.php`

```php
<?php

return [

    /*
    |-----------------------------------------------------------------
    | Default Prefix
    |-----------------------------------------------------------------
    |
    | This config option allows you to define a default prefix for
    | your icons. The dash separator will be applied automatically
    | to every icon name. It's required and needs to be unique.
    |
    */

    'prefix' => 'heroicon',

    /*
    |-----------------------------------------------------------------
    | Fallback Icon
    |-----------------------------------------------------------------
    |
    | This config option allows you to define a fallback
    | icon when an icon in this set cannot be found.
    |
    */

    'fallback' => '',

    /*
    |-----------------------------------------------------------------
    | Default Set Classes
    |-----------------------------------------------------------------
    |
    | This config option allows you to define some classes which
    | will be applied by default to all icons within this set.
    |
    */

    'class' => '',

    /*
    |-----------------------------------------------------------------
    | Default Set Attributes
    |-----------------------------------------------------------------
    |
    | This config option allows you to define some attributes which
    | will be applied by default to all icons within this set.
    |
    */

    'attributes' => [
        // 'width' => 50,
        // 'height' => 50,
    ],

];

```


---

**File:** `./config/blade-icons.php`

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Icons Sets
    |--------------------------------------------------------------------------
    |
    | With this config option you can define a couple of
    | default icon sets. Provide a key name for your icon
    | set and a combination from the options below.
    |
    */

    'sets' => [

        // 'default' => [
        //
        //     /*
        //     |-----------------------------------------------------------------
        //     | Icons Path
        //     |-----------------------------------------------------------------
        //     |
        //     | Provide the relative path from your app root to your SVG icons
        //     | directory. Icons are loaded recursively so there's no need to
        //     | list every sub-directory.
        //     |
        //     | Relative to the disk root when the disk option is set.
        //     |
        //     */
        //
        //     'path' => 'resources/svg',
        //
        //     /*
        //     |-----------------------------------------------------------------
        //     | Filesystem Disk
        //     |-----------------------------------------------------------------
        //     |
        //     | Optionally, provide a specific filesystem disk to read
        //     | icons from. When defining a disk, the "path" option
        //     | starts relatively from the disk root.
        //     |
        //     */
        //
        //     'disk' => '',
        //
        //     /*
        //     |-----------------------------------------------------------------
        //     | Default Prefix
        //     |-----------------------------------------------------------------
        //     |
        //     | This config option allows you to define a default prefix for
        //     | your icons. The dash separator will be applied automatically
        //     | to every icon name. It's required and needs to be unique.
        //     |
        //     */
        //
        //     'prefix' => 'icon',
        //
        //     /*
        //     |-----------------------------------------------------------------
        //     | Fallback Icon
        //     |-----------------------------------------------------------------
        //     |
        //     | This config option allows you to define a fallback
        //     | icon when an icon in this set cannot be found.
        //     |
        //     */
        //
        //     'fallback' => '',
        //
        //     /*
        //     |-----------------------------------------------------------------
        //     | Default Set Classes
        //     |-----------------------------------------------------------------
        //     |
        //     | This config option allows you to define some classes which
        //     | will be applied by default to all icons within this set.
        //     |
        //     */
        //
        //     'class' => '',
        //
        //     /*
        //     |-----------------------------------------------------------------
        //     | Default Set Attributes
        //     |-----------------------------------------------------------------
        //     |
        //     | This config option allows you to define some attributes which
        //     | will be applied by default to all icons within this set.
        //     |
        //     */
        //
        //     'attributes' => [
        //         // 'width' => 50,
        //         // 'height' => 50,
        //     ],
        //
        // ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Global Default Classes
    |--------------------------------------------------------------------------
    |
    | This config option allows you to define some classes which
    | will be applied by default to all icons.
    |
    */

    'class' => '',

    /*
    |--------------------------------------------------------------------------
    | Global Default Attributes
    |--------------------------------------------------------------------------
    |
    | This config option allows you to define some attributes which
    | will be applied by default to all icons.
    |
    */

    'attributes' => [
        // 'width' => 50,
        // 'height' => 50,
    ],

    /*
    |--------------------------------------------------------------------------
    | Global Fallback Icon
    |--------------------------------------------------------------------------
    |
    | This config option allows you to define a global fallback
    | icon when an icon in any set cannot be found. It can
    | reference any icon from any configured set.
    |
    */

    'fallback' => '',

    /*
    |--------------------------------------------------------------------------
    | Components
    |--------------------------------------------------------------------------
    |
    | These config options allow you to define some
    | settings related to Blade Components.
    |
    */

    'components' => [

        /*
        |----------------------------------------------------------------------
        | Disable Components
        |----------------------------------------------------------------------
        |
        | This config option allows you to disable Blade components
        | completely. It's useful to avoid performance problems
        | when working with large icon libraries.
        |
        */

        'disabled' => false,

        /*
        |----------------------------------------------------------------------
        | Default Icon Component Name
        |----------------------------------------------------------------------
        |
        | This config option allows you to define the name
        | for the default Icon class component.
        |
        */

        'default' => 'icon',

    ],

];

```


---

**File:** `./config/blade-lucide-icons.php`

```php
<?php

return [

    /*
    |-----------------------------------------------------------------
    | Default Prefix
    |-----------------------------------------------------------------
    |
    | This config option allows you to define a default prefix for
    | your icons. The dash separator will be applied automatically
    | to every icon name. It's required and needs to be unique.
    |
    */

    'prefix' => 'lucide',

    /*
    |-----------------------------------------------------------------
    | Fallback Icon
    |-----------------------------------------------------------------
    |
    | This config option allows you to define a fallback
    | icon when an icon in this set cannot be found.
    |
    */

    'fallback' => '',

    /*
    |-----------------------------------------------------------------
    | Default Set Classes
    |-----------------------------------------------------------------
    |
    | This config option allows you to define some classes which
    | will be applied by default to all icons within this set.
    |
    */

    'class' => '',

    /*
    |-----------------------------------------------------------------
    | Default Set Attributes
    |-----------------------------------------------------------------
    |
    | This config option allows you to define some attributes which
    | will be applied by default to all icons within this set.
    |
    */

    'attributes' => [
        // 'width' => 50,
        // 'height' => 50,
    ],

];

```


---

**File:** `./config/boost.php`

```php
<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Boost Master Switch
    |--------------------------------------------------------------------------
    |
    | This option may be used to disable all Boost functionality - which
    | will prevent Boost's routes from being registered and will also
    | disable Boost's browser logging functionality from operating.
    |
    */

    'enabled' => env('BOOST_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Boost Browser Logs Watcher
    |--------------------------------------------------------------------------
    |
    | The following option may be used to enable or disable the browser logs
    | watcher feature within Laravel Boost. The log watcher will read any
    | errors within the browser's console to give Boost better context.
    |
    */

    'browser_logs_watcher' => env('BOOST_BROWSER_LOGS_WATCHER', true),

    /*
    |--------------------------------------------------------------------------
    | Boost Executables Paths
    |--------------------------------------------------------------------------
    |
    | These options allow you to specify custom paths for the executables that
    | Boost uses. When configured, they take precedence over the automatic
    | discovery mechanism. Leave empty to use defaults from your $PATH.
    |
    */

    'executable_paths' => [
        'php' => env('BOOST_PHP_EXECUTABLE_PATH'),
        'composer' => env('BOOST_COMPOSER_EXECUTABLE_PATH'),
        'npm' => env('BOOST_NPM_EXECUTABLE_PATH'),
        'vendor_bin' => env('BOOST_VENDOR_BIN_EXECUTABLE_PATH'),
    ],

];

```


---

**File:** `./config/broadcasting.php`

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Broadcaster
    |--------------------------------------------------------------------------
    |
    | This option controls the default broadcaster that will be used by the
    | framework when an event needs to be broadcast. You may set this to
    | any of the connections defined in the "connections" array below.
    |
    | Supported: "pusher", "ably", "redis", "log", "null"
    |
    */

    'default' => env('BROADCAST_DRIVER', 'null'),

    /*
    |--------------------------------------------------------------------------
    | Broadcast Connections
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the broadcast connections that will be used
    | to broadcast events to other systems or over websockets. Samples of
    | each available type of connection are provided inside this array.
    |
    */

    'connections' => [

        'pusher' => [
            'driver' => 'pusher',
            'key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
            'app_id' => env('PUSHER_APP_ID'),
            'options' => [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'host' => env('PUSHER_HOST') ?: 'api-'.env('PUSHER_APP_CLUSTER', 'mt1').'.pusher.com',
                'port' => env('PUSHER_PORT', 443),
                'scheme' => env('PUSHER_SCHEME', 'https'),
                'encrypted' => true,
                'useTLS' => env('PUSHER_SCHEME', 'https') === 'https',
            ],
            'client_options' => [
                // Guzzle client options: https://docs.guzzlephp.org/en/stable/request-options.html
            ],
        ],

        'ably' => [
            'driver' => 'ably',
            'key' => env('ABLY_KEY'),
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
        ],

        'log' => [
            'driver' => 'log',
        ],

        'null' => [
            'driver' => 'null',
        ],

    ],

];

```


---

**File:** `./config/cache.php`

```php
<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Cache Store
    |--------------------------------------------------------------------------
    |
    | This option controls the default cache connection that gets used while
    | using this caching library. This connection is used when another is
    | not explicitly specified when executing a given caching function.
    |
    */

    'default' => env('CACHE_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | Cache Stores
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the cache "stores" for your application as
    | well as their drivers. You may even define multiple stores for the
    | same cache driver to group types of items stored in your caches.
    |
    | Supported drivers: "apc", "array", "database", "file",
    |         "memcached", "redis", "dynamodb", "octane", "null"
    |
    */

    'stores' => [

        'apc' => [
            'driver' => 'apc',
        ],

        'array' => [
            'driver' => 'array',
            'serialize' => false,
        ],

        'database' => [
            'driver' => 'database',
            'table' => 'cache',
            'connection' => null,
            'lock_connection' => null,
        ],

        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
            'lock_path' => storage_path('framework/cache/data'),
        ],

        'memcached' => [
            'driver' => 'memcached',
            'persistent_id' => env('MEMCACHED_PERSISTENT_ID'),
            'sasl' => [
                env('MEMCACHED_USERNAME'),
                env('MEMCACHED_PASSWORD'),
            ],
            'options' => [
                // Memcached::OPT_CONNECT_TIMEOUT => 2000,
            ],
            'servers' => [
                [
                    'host' => env('MEMCACHED_HOST', '127.0.0.1'),
                    'port' => env('MEMCACHED_PORT', 11211),
                    'weight' => 100,
                ],
            ],
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'cache',
            'lock_connection' => 'default',
        ],

        'dynamodb' => [
            'driver' => 'dynamodb',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'table' => env('DYNAMODB_CACHE_TABLE', 'cache'),
            'endpoint' => env('DYNAMODB_ENDPOINT'),
        ],

        'octane' => [
            'driver' => 'octane',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Key Prefix
    |--------------------------------------------------------------------------
    |
    | When utilizing the APC, database, memcached, Redis, or DynamoDB cache
    | stores there might be other applications using the same cache. For
    | that reason, you may prefix every cache key to avoid collisions.
    |
    */

    'prefix' => env('CACHE_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_cache_'),

];

```


---

**File:** `./config/cartalyst.converter.php`

```php
<?php

/*
 * Part of the Converter package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Converter
 * @version    9.0.0
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011-2024, Cartalyst LLC
 * @link       https://cartalyst.com
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Measurements
    |--------------------------------------------------------------------------
    |
    | The available measurements to convert and format units.
    |
    */

    'measurements' => [
        /*
        |--------------------------------------------------------------------------
        | Area
        |--------------------------------------------------------------------------
        |
        | The available measurements to convert and format areas.
        |
        */

        'area' => [
            'sqm' => [
                'format' => '1,00.00 sq m',
                'unit'   => 1,
            ],

            'acre' => [
                'format' => '1,00.000 ac',
                'unit'   => 0.000247105,
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Currency
        |--------------------------------------------------------------------------
        |
        | The available measurements to convert and format currencies.
        |
        */

        'currency' => [
            'usd' => [
                'format' => '$1,0.00',
            ],

            'eur' => [
                'format' => '&euro;1,0.00',
            ],

            'gbp' => [
                'format' => '&pound;1,0.00',
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Length
        |--------------------------------------------------------------------------
        |
        | The available measurements to convert and format lengths.
        |
        */

        'length' => [
            'km' => [
                'format' => '1,0.000 km',
                'unit'   => 0.001,
            ],

            'mi' => [
                'format' => '1,0.000 mi.',
                'unit'   => 0.000621371,
            ],

            'm' => [
                'format' => '1,0.000 m',
                'unit'   => 1.00,
            ],

            'cm' => [
                'format' => '1!0 cm',
                'unit'   => 100,
            ],

            'mm' => [
                'format' => '1,0.00 mm',
                'unit'   => 1000,
            ],

            'ft' => [
                'format' => '1,0.00 ft.',
                'unit'   => 3.28084,
            ],

            'in' => [
                'format' => '1,0.00 in.',
                'unit'   => 39.3701,
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Weight
        |--------------------------------------------------------------------------
        |
        | The available measurements to convert and format weights.
        |
        */

        'weight' => [
            'kg' => [
                'format' => '1,0.00 kg',
                'unit'   => 1.00,
            ],

            'g' => [
                'format' => '1,0.00 g',
                'unit'   => 1000.00,
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Temperature
        |--------------------------------------------------------------------------
        |
        | The available measurements to convert and format temperatures.
        |
        */

        'temperature' => [
            'c' => [
                'format' => '1,0.00 C',
                'unit'   => 1.00,
            ],

            'f' => [
                'format' => '1,0.00 °F',
                'unit'   => 1.80,
                'offset' => 32,
            ],

            'k' => [
                'format' => '1,0.00 K',
                'unit'   => 1.00,
                'offset' => 273.15,
            ],

            'rankine' => [
                'format' => '1,0.00 °R',
                'unit'   => 1.80,
                'offset' => 491.67,
            ],

            'romer' => [
                'format' => '1,0.00 °Rø',
                'unit'   => 0.525,
                'offset' => 7.5,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Currency Cache Expiration Duration
    |--------------------------------------------------------------------------
    |
    | The duration currency rates are cached in minutes.
    |
    */

    'expires' => 60,

    /*
    |--------------------------------------------------------------------------
    | Currency Service Exchangers
    |--------------------------------------------------------------------------
    |
    | Here, you may specify any number of service exchangers configurations
    | your application requires.
    |
    */

    'exchangers' => [
        /*
        |--------------------------------------------------------------------------
        | Default Exchanger
        |--------------------------------------------------------------------------
        |
        | Define here the default exchanger.
        |
        */

        'default' => 'native',

        /*
        |--------------------------------------------------------------------------
        | OpenExchangeRates.org
        |--------------------------------------------------------------------------
        |
        | Define here the OpenExchangeRates.org app id.
        |
        */

        'openexchangerates' => [
            'app_id' => null,
        ],
    ],
];

```


---

**File:** `./config/cors.php`

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];

```


---

**File:** `./config/database.php`

```php
<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

    ],

];

```


---

**File:** `./config/dompdf.php`

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    |
    | Set some default values. It is possible to add all defines that can be set
    | in dompdf_config.inc.php. You can also override the entire config file.
    |
    */
    'show_warnings' => false,   // Throw an Exception on warnings from dompdf

    'public_path' => null,  // Override the public path if needed

    /*
     * Dejavu Sans font is missing glyphs for converted entities, turn it off if you need to show € and £.
     */
    'convert_entities' => true,

    'options' => [
        /**
         * The location of the DOMPDF font directory
         *
         * The location of the directory where DOMPDF will store fonts and font metrics
         * Note: This directory must exist and be writable by the webserver process.
         * *Please note the trailing slash.*
         *
         * Notes regarding fonts:
         * Additional .afm font metrics can be added by executing load_font.php from command line.
         *
         * Only the original "Base 14 fonts" are present on all pdf viewers. Additional fonts must
         * be embedded in the pdf file or the PDF may not display correctly. This can significantly
         * increase file size unless font subsetting is enabled. Before embedding a font please
         * review your rights under the font license.
         *
         * Any font specification in the source HTML is translated to the closest font available
         * in the font directory.
         *
         * The pdf standard "Base 14 fonts" are:
         * Courier, Courier-Bold, Courier-BoldOblique, Courier-Oblique,
         * Helvetica, Helvetica-Bold, Helvetica-BoldOblique, Helvetica-Oblique,
         * Times-Roman, Times-Bold, Times-BoldItalic, Times-Italic,
         * Symbol, ZapfDingbats.
         */
        'font_dir' => storage_path('fonts'), // advised by dompdf (https://github.com/dompdf/dompdf/pull/782)

        /**
         * The location of the DOMPDF font cache directory
         *
         * This directory contains the cached font metrics for the fonts used by DOMPDF.
         * This directory can be the same as DOMPDF_FONT_DIR
         *
         * Note: This directory must exist and be writable by the webserver process.
         */
        'font_cache' => storage_path('fonts'),

        /**
         * The location of a temporary directory.
         *
         * The directory specified must be writeable by the webserver process.
         * The temporary directory is required to download remote images and when
         * using the PDFLib back end.
         */
        'temp_dir' => sys_get_temp_dir(),

        /**
         * ==== IMPORTANT ====
         *
         * dompdf's "chroot": Prevents dompdf from accessing system files or other
         * files on the webserver.  All local files opened by dompdf must be in a
         * subdirectory of this directory.  DO NOT set it to '/' since this could
         * allow an attacker to use dompdf to read any files on the server.  This
         * should be an absolute path.
         * This is only checked on command line call by dompdf.php, but not by
         * direct class use like:
         * $dompdf = new DOMPDF();  $dompdf->load_html($htmldata); $dompdf->render(); $pdfdata = $dompdf->output();
         */
        'chroot' => realpath(base_path()),

        /**
         * Protocol whitelist
         *
         * Protocols and PHP wrappers allowed in URIs, and the validation rules
         * that determine if a resouce may be loaded. Full support is not guaranteed
         * for the protocols/wrappers specified
         * by this array.
         *
         * @var array
         */
        'allowed_protocols' => [
            'data://' => ['rules' => []],
            'file://' => ['rules' => []],
            'http://' => ['rules' => []],
            'https://' => ['rules' => []],
        ],

        /**
         * Operational artifact (log files, temporary files) path validation
         */
        'artifactPathValidation' => null,

        /**
         * @var string
         */
        'log_output_file' => null,

        /**
         * Whether to enable font subsetting or not.
         */
        'enable_font_subsetting' => false,

        /**
         * The PDF rendering backend to use
         *
         * Valid settings are 'PDFLib', 'CPDF' (the bundled R&OS PDF class), 'GD' and
         * 'auto'. 'auto' will look for PDFLib and use it if found, or if not it will
         * fall back on CPDF. 'GD' renders PDFs to graphic files.
         * {@link * Canvas_Factory} ultimately determines which rendering class to
         * instantiate based on this setting.
         *
         * Both PDFLib & CPDF rendering backends provide sufficient rendering
         * capabilities for dompdf, however additional features (e.g. object,
         * image and font support, etc.) differ between backends.  Please see
         * {@link PDFLib_Adapter} for more information on the PDFLib backend
         * and {@link CPDF_Adapter} and lib/class.pdf.php for more information
         * on CPDF. Also see the documentation for each backend at the links
         * below.
         *
         * The GD rendering backend is a little different than PDFLib and
         * CPDF. Several features of CPDF and PDFLib are not supported or do
         * not make any sense when creating image files.  For example,
         * multiple pages are not supported, nor are PDF 'objects'.  Have a
         * look at {@link GD_Adapter} for more information.  GD support is
         * experimental, so use it at your own risk.
         *
         * @link http://www.pdflib.com
         * @link http://www.ros.co.nz/pdf
         * @link http://www.php.net/image
         */
        'pdf_backend' => 'CPDF',

        /**
         * html target media view which should be rendered into pdf.
         * List of types and parsing rules for future extensions:
         * http://www.w3.org/TR/REC-html40/types.html
         *   screen, tty, tv, projection, handheld, print, braille, aural, all
         * Note: aural is deprecated in CSS 2.1 because it is replaced by speech in CSS 3.
         * Note, even though the generated pdf file is intended for print output,
         * the desired content might be different (e.g. screen or projection view of html file).
         * Therefore allow specification of content here.
         */
        'default_media_type' => 'screen',

        /**
         * The default paper size.
         *
         * North America standard is "letter"; other countries generally "a4"
         *
         * @see CPDF_Adapter::PAPER_SIZES for valid sizes ('letter', 'legal', 'A4', etc.)
         */
        'default_paper_size' => 'a4',

        /**
         * The default paper orientation.
         *
         * The orientation of the page (portrait or landscape).
         *
         * @var string
         */
        'default_paper_orientation' => 'portrait',

        /**
         * The default font family
         *
         * Used if no suitable fonts can be found. This must exist in the font folder.
         *
         * @var string
         */
        'default_font' => 'serif',

        /**
         * Image DPI setting
         *
         * This setting determines the default DPI setting for images and fonts.  The
         * DPI may be overridden for inline images by explictly setting the
         * image's width & height style attributes (i.e. if the image's native
         * width is 600 pixels and you specify the image's width as 72 points,
         * the image will have a DPI of 600 in the rendered PDF.  The DPI of
         * background images can not be overridden and is controlled entirely
         * via this parameter.
         *
         * For the purposes of DOMPDF, pixels per inch (PPI) = dots per inch (DPI).
         * If a size in html is given as px (or without unit as image size),
         * this tells the corresponding size in pt.
         * This adjusts the relative sizes to be similar to the rendering of the
         * html page in a reference browser.
         *
         * In pdf, always 1 pt = 1/72 inch
         *
         * Rendering resolution of various browsers in px per inch:
         * Windows Firefox and Internet Explorer:
         *   SystemControl->Display properties->FontResolution: Default:96, largefonts:120, custom:?
         * Linux Firefox:
         *   about:config *resolution: Default:96
         *   (xorg screen dimension in mm and Desktop font dpi settings are ignored)
         *
         * Take care about extra font/image zoom factor of browser.
         *
         * In images, <img> size in pixel attribute, img css style, are overriding
         * the real image dimension in px for rendering.
         *
         * @var int
         */
        'dpi' => 96,

        /**
         * Enable embedded PHP
         *
         * If this setting is set to true then DOMPDF will automatically evaluate embedded PHP contained
         * within <script type="text/php"> ... </script> tags.
         *
         * ==== IMPORTANT ==== Enabling this for documents you do not trust (e.g. arbitrary remote html pages)
         * is a security risk.
         * Embedded scripts are run with the same level of system access available to dompdf.
         * Set this option to false (recommended) if you wish to process untrusted documents.
         * This setting may increase the risk of system exploit.
         * Do not change this settings without understanding the consequences.
         * Additional documentation is available on the dompdf wiki at:
         * https://github.com/dompdf/dompdf/wiki
         *
         * @var bool
         */
        'enable_php' => false,

        /**
         * Rnable inline JavaScript
         *
         * If this setting is set to true then DOMPDF will automatically insert JavaScript code contained
         * within <script type="text/javascript"> ... </script> tags as written into the PDF.
         * NOTE: This is PDF-based JavaScript to be executed by the PDF viewer,
         * not browser-based JavaScript executed by Dompdf.
         *
         * @var bool
         */
        'enable_javascript' => true,

        /**
         * Enable remote file access
         *
         *  If this setting is set to true, DOMPDF will access remote sites for
         *  images and CSS files as required.
         *
         *  ==== IMPORTANT ====
         *  This can be a security risk, in particular in combination with isPhpEnabled and
         *  allowing remote html code to be passed to $dompdf = new DOMPDF(); $dompdf->load_html(...);
         *  This allows anonymous users to download legally doubtful internet content which on
         *  tracing back appears to being downloaded by your server, or allows malicious php code
         *  in remote html pages to be executed by your server with your account privileges.
         *
         *  This setting may increase the risk of system exploit. Do not change
         *  this settings without understanding the consequences. Additional
         *  documentation is available on the dompdf wiki at:
         *  https://github.com/dompdf/dompdf/wiki
         *
         * @var bool
         */
        'enable_remote' => false,

        /**
         * List of allowed remote hosts
         *
         * Each value of the array must be a valid hostname.
         *
         * This will be used to filter which resources can be loaded in combination with
         * isRemoteEnabled. If enable_remote is FALSE, then this will have no effect.
         *
         * Leave to NULL to allow any remote host.
         *
         * @var array|null
         */
        'allowed_remote_hosts' => null,

        /**
         * A ratio applied to the fonts height to be more like browsers' line height
         */
        'font_height_ratio' => 1.1,

        /**
         * Use the HTML5 Lib parser
         *
         * @deprecated This feature is now always on in dompdf 2.x
         *
         * @var bool
         */
        'enable_html5_parser' => true,
    ],

];

```


---

**File:** `./config/filament-apex-charts.php`

```php
<?php

// config for Leandrocfe/FilamentApexCharts
return [

    // command options
    'chart_options' => [
        'Empty',
        'Area',
        'Bar',
        'Boxplot',
        'Bubble',
        'Candlestick',
        'Column',
        'Donut',
        'Heatmap',
        'Line',
        'Mixed-LineAndColumn',
        'Pie',
        'PolarArea',
        'Radar',
        'Radialbar',
        'RangeArea',
        'Scatter',
        'TimelineRangeBars',
        'Treemap',
        'Funnel',
    ],
];

```


---

**File:** `./config/filament.php`

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Broadcasting
    |--------------------------------------------------------------------------
    |
    | By uncommenting the Laravel Echo configuration, you may connect Filament
    | to any Pusher-compatible websockets server.
    |
    | This will allow your users to receive real-time notifications.
    |
    */

    'broadcasting' => [

        // 'echo' => [
        //     'broadcaster' => 'pusher',
        //     'key' => env('VITE_PUSHER_APP_KEY'),
        //     'cluster' => env('VITE_PUSHER_APP_CLUSTER'),
        //     'wsHost' => env('VITE_PUSHER_HOST'),
        //     'wsPort' => env('VITE_PUSHER_PORT'),
        //     'wssPort' => env('VITE_PUSHER_PORT'),
        //     'authEndpoint' => '/broadcasting/auth',
        //     'disableStats' => true,
        //     'encrypted' => true,
        //     'forceTLS' => true,
        // ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | This is the storage disk Filament will use to store files. You may use
    | any of the disks defined in the `config/filesystems.php`.
    |
    */

    'default_filesystem_disk' => env('FILAMENT_FILESYSTEM_DISK', 'public'),

    /*
    |--------------------------------------------------------------------------
    | Assets Path
    |--------------------------------------------------------------------------
    |
    | This is the directory where Filament's assets will be published to. It
    | is relative to the `public` directory of your Laravel application.
    |
    | After changing the path, you should run `php artisan filament:assets`.
    |
    */

    'assets_path' => null,

    /*
    |--------------------------------------------------------------------------
    | Cache Path
    |--------------------------------------------------------------------------
    |
    | This is the directory that Filament will use to store cache files that
    | are used to optimize the registration of components.
    |
    | After changing the path, you should run `php artisan filament:cache-components`.
    |
    */

    'cache_path' => base_path('bootstrap/cache/filament'),

    /*
    |--------------------------------------------------------------------------
    | Livewire Loading Delay
    |--------------------------------------------------------------------------
    |
    | This sets the delay before loading indicators appear.
    |
    | Setting this to 'none' makes indicators appear immediately, which can be
    | desirable for high-latency connections. Setting it to 'default' applies
    | Livewire's standard 200ms delay.
    |
    */

    'livewire_loading_delay' => 'default',

    /*
    |--------------------------------------------------------------------------
    | System Route Prefix
    |--------------------------------------------------------------------------
    |
    | This is the prefix used for the system routes that Filament registers,
    | such as the routes for downloading exports and failed import rows.
    |
    */

    'system_route_prefix' => 'filament',

];

```


---

**File:** `./config/filesystems.php`

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];

```


---

**File:** `./config/flare.php`

```php
<?php

use Spatie\FlareClient\FlareMiddleware\AddGitInformation;
use Spatie\FlareClient\FlareMiddleware\RemoveRequestIp;
use Spatie\FlareClient\FlareMiddleware\CensorRequestBodyFields;
use Spatie\FlareClient\FlareMiddleware\CensorRequestHeaders;
use Spatie\LaravelIgnition\FlareMiddleware\AddDumps;
use Spatie\LaravelIgnition\FlareMiddleware\AddEnvironmentInformation;
use Spatie\LaravelIgnition\FlareMiddleware\AddExceptionHandledStatus;
use Spatie\LaravelIgnition\FlareMiddleware\AddExceptionInformation;
use Spatie\LaravelIgnition\FlareMiddleware\AddJobs;
use Spatie\LaravelIgnition\FlareMiddleware\AddLogs;
use Spatie\LaravelIgnition\FlareMiddleware\AddQueries;
use Spatie\LaravelIgnition\FlareMiddleware\AddContext;
use Spatie\LaravelIgnition\FlareMiddleware\AddNotifierName;

return [
    /*
    |
    |--------------------------------------------------------------------------
    | Flare API key
    |--------------------------------------------------------------------------
    |
    | Specify Flare's API key below to enable error reporting to the service.
    |
    | More info: https://flareapp.io/docs/general/projects
    |
    */

    'key' => env('FLARE_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will modify the contents of the report sent to Flare.
    |
    */

    'flare_middleware' => [
        RemoveRequestIp::class,
        AddGitInformation::class,
        AddNotifierName::class,
        AddEnvironmentInformation::class,
        AddExceptionInformation::class,
        AddDumps::class,
        AddLogs::class => [
            'maximum_number_of_collected_logs' => 200,
        ],
        AddQueries::class => [
            'maximum_number_of_collected_queries' => 200,
            'report_query_bindings' => true,
        ],
        AddJobs::class => [
            'max_chained_job_reporting_depth' => 5,
        ],
        AddContext::class,
        AddExceptionHandledStatus::class,
        CensorRequestBodyFields::class => [
            'censor_fields' => [
                'password',
                'password_confirmation',
            ],
        ],
        CensorRequestHeaders::class => [
            'headers' => [
                'API-KEY',
                'Authorization',
                'Cookie',
                'Set-Cookie',
                'X-CSRF-TOKEN',
                'X-XSRF-TOKEN',
            ]
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Reporting log statements
    |--------------------------------------------------------------------------
    |
    | If this setting is `false` log statements won't be sent as events to Flare,
    | no matter which error level you specified in the Flare log channel.
    |
    */

    'send_logs_as_events' => true,
];

```


---

**File:** `./config/hashing.php`

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Hash Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default hash driver that will be used to hash
    | passwords for your application. By default, the bcrypt algorithm is
    | used; however, you remain free to modify this option if you wish.
    |
    | Supported: "bcrypt", "argon", "argon2id"
    |
    */

    'driver' => 'bcrypt',

    /*
    |--------------------------------------------------------------------------
    | Bcrypt Options
    |--------------------------------------------------------------------------
    |
    | Here you may specify the configuration options that should be used when
    | passwords are hashed using the Bcrypt algorithm. This will allow you
    | to control the amount of time it takes to hash the given password.
    |
    */

    'bcrypt' => [
        'rounds' => env('BCRYPT_ROUNDS', 12),
        'verify' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Argon Options
    |--------------------------------------------------------------------------
    |
    | Here you may specify the configuration options that should be used when
    | passwords are hashed using the Argon algorithm. These will allow you
    | to control the amount of time it takes to hash the given password.
    |
    */

    'argon' => [
        'memory' => 65536,
        'threads' => 1,
        'time' => 4,
    ],

];

```


---

**File:** `./config/ignition.php`

```php
<?php

use Spatie\Ignition\Solutions\SolutionProviders\BadMethodCallSolutionProvider;
use Spatie\Ignition\Solutions\SolutionProviders\MergeConflictSolutionProvider;
use Spatie\Ignition\Solutions\SolutionProviders\UndefinedPropertySolutionProvider;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\DumpRecorder;
use Spatie\LaravelIgnition\Recorders\JobRecorder\JobRecorder;
use Spatie\LaravelIgnition\Recorders\LogRecorder\LogRecorder;
use Spatie\LaravelIgnition\Recorders\QueryRecorder\QueryRecorder;
use Spatie\LaravelIgnition\Solutions\SolutionProviders\DefaultDbNameSolutionProvider;
use Spatie\LaravelIgnition\Solutions\SolutionProviders\GenericLaravelExceptionSolutionProvider;
use Spatie\LaravelIgnition\Solutions\SolutionProviders\IncorrectValetDbCredentialsSolutionProvider;
use Spatie\LaravelIgnition\Solutions\SolutionProviders\InvalidRouteActionSolutionProvider;
use Spatie\LaravelIgnition\Solutions\SolutionProviders\MissingAppKeySolutionProvider;
use Spatie\LaravelIgnition\Solutions\SolutionProviders\MissingColumnSolutionProvider;
use Spatie\LaravelIgnition\Solutions\SolutionProviders\MissingImportSolutionProvider;
use Spatie\LaravelIgnition\Solutions\SolutionProviders\MissingLivewireComponentSolutionProvider;
use Spatie\LaravelIgnition\Solutions\SolutionProviders\MissingMixManifestSolutionProvider;
use Spatie\LaravelIgnition\Solutions\SolutionProviders\MissingViteManifestSolutionProvider;
use Spatie\LaravelIgnition\Solutions\SolutionProviders\RunningLaravelDuskInProductionProvider;
use Spatie\LaravelIgnition\Solutions\SolutionProviders\TableNotFoundSolutionProvider;
use Spatie\LaravelIgnition\Solutions\SolutionProviders\UndefinedViewVariableSolutionProvider;
use Spatie\LaravelIgnition\Solutions\SolutionProviders\UnknownValidationSolutionProvider;
use Spatie\LaravelIgnition\Solutions\SolutionProviders\ViewNotFoundSolutionProvider;
use Spatie\LaravelIgnition\Solutions\SolutionProviders\OpenAiSolutionProvider;
use Spatie\LaravelIgnition\Solutions\SolutionProviders\SailNetworkSolutionProvider;
use Spatie\LaravelIgnition\Solutions\SolutionProviders\UnknownMariadbCollationSolutionProvider;
use Spatie\LaravelIgnition\Solutions\SolutionProviders\UnknownMysql8CollationSolutionProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | Editor
    |--------------------------------------------------------------------------
    |
    | Choose your preferred editor to use when clicking any edit button.
    |
    | Supported: "phpstorm", "vscode", "vscode-insiders", "textmate", "emacs",
    |            "sublime", "atom", "nova", "macvim", "idea", "netbeans",
    |            "xdebug", "phpstorm-remote"
    |
    */

    'editor' => env('IGNITION_EDITOR', 'phpstorm'),

    /*
    |--------------------------------------------------------------------------
    | Theme
    |--------------------------------------------------------------------------
    |
    | Here you may specify which theme Ignition should use.
    |
    | Supported: "light", "dark", "auto"
    |
    */

    'theme' => env('IGNITION_THEME', 'auto'),

    /*
    |--------------------------------------------------------------------------
    | Sharing
    |--------------------------------------------------------------------------
    |
    | You can share local errors with colleagues or others around the world.
    | Sharing is completely free and doesn't require an account on Flare.
    |
    | If necessary, you can completely disable sharing below.
    |
    */

    'enable_share_button' => env('IGNITION_SHARING_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Register Ignition commands
    |--------------------------------------------------------------------------
    |
    | Ignition comes with an additional make command that lets you create
    | new solution classes more easily. To keep your default Laravel
    | installation clean, this command is not registered by default.
    |
    | You can enable the command registration below.
    |
    */

    'register_commands' => env('REGISTER_IGNITION_COMMANDS', false),

    /*
    |--------------------------------------------------------------------------
    | Solution Providers
    |--------------------------------------------------------------------------
    |
    | List of solution providers that should be loaded. You may specify additional 
    | providers as fully qualified class names. 
    |
    */

    'solution_providers' => [
        // from spatie/ignition
        BadMethodCallSolutionProvider::class,
        MergeConflictSolutionProvider::class,
        UndefinedPropertySolutionProvider::class,

        // from spatie/laravel-ignition
        IncorrectValetDbCredentialsSolutionProvider::class,
        MissingAppKeySolutionProvider::class,
        DefaultDbNameSolutionProvider::class,
        TableNotFoundSolutionProvider::class,
        MissingImportSolutionProvider::class,
        InvalidRouteActionSolutionProvider::class,
        ViewNotFoundSolutionProvider::class,
        RunningLaravelDuskInProductionProvider::class,
        MissingColumnSolutionProvider::class,
        UnknownValidationSolutionProvider::class,
        MissingMixManifestSolutionProvider::class,
        MissingViteManifestSolutionProvider::class,
        MissingLivewireComponentSolutionProvider::class,
        UndefinedViewVariableSolutionProvider::class,
        GenericLaravelExceptionSolutionProvider::class,
        OpenAiSolutionProvider::class,
        SailNetworkSolutionProvider::class,
        UnknownMysql8CollationSolutionProvider::class,
        UnknownMariadbCollationSolutionProvider::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Ignored Solution Providers
    |--------------------------------------------------------------------------
    |
    | You may specify a list of solution providers (as fully qualified class
    | names) that shouldn't be loaded. Ignition will ignore these classes
    | and possible solutions provided by them will never be displayed.
    |
    */

    'ignored_solution_providers' => [

    ],

    /*
    |--------------------------------------------------------------------------
    | Runnable Solutions
    |--------------------------------------------------------------------------
    |
    | Some solutions that Ignition displays are runnable and can perform
    | various tasks. By default, runnable solutions are only enabled when your
    | app has debug mode enabled and the environment is `local` or
    | `development`.
    |
    | Using the `IGNITION_ENABLE_RUNNABLE_SOLUTIONS` environment variable, you
    | can override this behaviour and enable or disable runnable solutions
    | regardless of the application's environment.
    |
    | Default: env('IGNITION_ENABLE_RUNNABLE_SOLUTIONS')
    |
    */

    'enable_runnable_solutions' => env('IGNITION_ENABLE_RUNNABLE_SOLUTIONS'),

    /*
    |--------------------------------------------------------------------------
    | Remote Path Mapping
    |--------------------------------------------------------------------------
    |
    | If you are using a remote dev server, like Laravel Homestead, Docker, or
    | even a remote VPS, it will be necessary to specify your path mapping.
    |
    | Leaving one, or both of these, empty or null will not trigger the remote
    | URL changes and Ignition will treat your editor links as local files.
    |
    | "remote_sites_path" is an absolute base path for your sites or projects
    | in Homestead, Vagrant, Docker, or another remote development server.
    |
    | Example value: "/home/vagrant/Code"
    |
    | "local_sites_path" is an absolute base path for your sites or projects
    | on your local computer where your IDE or code editor is running on.
    |
    | Example values: "/Users/<name>/Code", "C:\Users\<name>\Documents\Code"
    |
    */

    'remote_sites_path' => env('IGNITION_REMOTE_SITES_PATH', base_path()),
    'local_sites_path' => env('IGNITION_LOCAL_SITES_PATH', ''),

    /*
    |--------------------------------------------------------------------------
    | Housekeeping Endpoint Prefix
    |--------------------------------------------------------------------------
    |
    | Ignition registers a couple of routes when it is enabled. Below you may
    | specify a route prefix that will be used to host all internal links.
    |
    */

    'housekeeping_endpoint_prefix' => '_ignition',

    /*
    |--------------------------------------------------------------------------
    | Settings File
    |--------------------------------------------------------------------------
    |
    | Ignition allows you to save your settings to a specific global file.
    |
    | If no path is specified, a file with settings will be saved to the user's
    | home directory. The directory depends on the OS and its settings but it's
    | typically `~/.ignition.json`. In this case, the settings will be applied
    | to all of your projects where Ignition is used and the path is not
    | specified.
    |
    | However, if you want to store your settings on a project basis, or you
    | want to keep them in another directory, you can specify a path where
    | the settings file will be saved. The path should be an existing directory
    | with correct write access.
    | For example, create a new `ignition` folder in the storage directory and
    | use `storage_path('ignition')` as the `settings_file_path`.
    |
    | Default value: '' (empty string)
    */

    'settings_file_path' => '',

    /*
    |--------------------------------------------------------------------------
    | Recorders
    |--------------------------------------------------------------------------
    |
    | Ignition registers a couple of recorders when it is enabled. Below you may
    | specify a recorders will be used to record specific events.
    |
    */

    'recorders' => [
        DumpRecorder::class,
        JobRecorder::class,
        LogRecorder::class,
        QueryRecorder::class,
    ],

    /*
     * When a key is set, we'll send your exceptions to Open AI to generate a solution
     */

    'open_ai_key' => env('IGNITION_OPEN_AI_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Include arguments
    |--------------------------------------------------------------------------
    |
    | Ignition show you stack traces of exceptions with the arguments that were
    | passed to each method. This feature can be disabled here.
    |
    */

    'with_stack_frame_arguments' => true,

    /*
    |--------------------------------------------------------------------------
    | Argument reducers
    |--------------------------------------------------------------------------
    |
    | Ignition show you stack traces of exceptions with the arguments that were
    | passed to each method. To make these variables more readable, you can
    | specify a list of classes here which summarize the variables.
    |
    */

    'argument_reducers' => [
        \Spatie\Backtrace\Arguments\Reducers\BaseTypeArgumentReducer::class,
        \Spatie\Backtrace\Arguments\Reducers\ArrayArgumentReducer::class,
        \Spatie\Backtrace\Arguments\Reducers\StdClassArgumentReducer::class,
        \Spatie\Backtrace\Arguments\Reducers\EnumArgumentReducer::class,
        \Spatie\Backtrace\Arguments\Reducers\ClosureArgumentReducer::class,
        \Spatie\Backtrace\Arguments\Reducers\DateTimeArgumentReducer::class,
        \Spatie\Backtrace\Arguments\Reducers\DateTimeZoneArgumentReducer::class,
        \Spatie\Backtrace\Arguments\Reducers\SymphonyRequestArgumentReducer::class,
        \Spatie\LaravelIgnition\ArgumentReducers\ModelArgumentReducer::class,
        \Spatie\LaravelIgnition\ArgumentReducers\CollectionArgumentReducer::class,
        \Spatie\Backtrace\Arguments\Reducers\StringableArgumentReducer::class,
    ],

];

```


---

**File:** `./config/livewire.php`

```php
<?php

return [

    /*
    |---------------------------------------------------------------------------
    | Class Namespace
    |---------------------------------------------------------------------------
    |
    | This value sets the root class namespace for Livewire component classes in
    | your application. This value will change where component auto-discovery
    | finds components. It's also referenced by the file creation commands.
    |
    */

    'class_namespace' => 'App\\Livewire',

    /*
    |---------------------------------------------------------------------------
    | View Path
    |---------------------------------------------------------------------------
    |
    | This value is used to specify where Livewire component Blade templates are
    | stored when running file creation commands like `artisan make:livewire`.
    | It is also used if you choose to omit a component's render() method.
    |
    */

    'view_path' => resource_path('views/livewire'),

    /*
    |---------------------------------------------------------------------------
    | Layout
    |---------------------------------------------------------------------------
    | The view that will be used as the layout when rendering a single component
    | as an entire page via `Route::get('/post/create', CreatePost::class);`.
    | In this case, the view returned by CreatePost will render into $slot.
    |
    */

    'layout' => 'layouts.storefront',

    /*
    |---------------------------------------------------------------------------
    | Lazy Loading Placeholder
    |---------------------------------------------------------------------------
    | Livewire allows you to lazy load components that would otherwise slow down
    | the initial page load. Every component can have a custom placeholder or
    | you can define the default placeholder view for all components below.
    |
    */

    'lazy_placeholder' => null,

    /*
    |---------------------------------------------------------------------------
    | Temporary File Uploads
    |---------------------------------------------------------------------------
    |
    | Livewire handles file uploads by storing uploads in a temporary directory
    | before the file is stored permanently. All file uploads are directed to
    | a global endpoint for temporary storage. You may configure this below:
    |
    */

    'temporary_file_upload' => [
        'disk' => null,        // Example: 'local', 's3'              | Default: 'default'
        'rules' => null,       // Example: ['file', 'mimes:png,jpg']  | Default: ['required', 'file', 'max:12288'] (12MB)
        'directory' => null,   // Example: 'tmp'                      | Default: 'livewire-tmp'
        'middleware' => null,  // Example: 'throttle:5,1'             | Default: 'throttle:60,1'
        'preview_mimes' => [   // Supported file types for temporary pre-signed file URLs...
            'png', 'gif', 'bmp', 'svg', 'wav', 'mp4',
            'mov', 'avi', 'wmv', 'mp3', 'm4a',
            'jpg', 'jpeg', 'mpga', 'webp', 'wma',
        ],
        'max_upload_time' => 5, // Max duration (in minutes) before an upload is invalidated...
    ],

    /*
    |---------------------------------------------------------------------------
    | Render On Redirect
    |---------------------------------------------------------------------------
    |
    | This value determines if Livewire will run a component's `render()` method
    | after a redirect has been triggered using something like `redirect(...)`
    | Setting this to true will render the view once more before redirecting
    |
    */

    'render_on_redirect' => false,

    /*
    |---------------------------------------------------------------------------
    | Eloquent Model Binding
    |---------------------------------------------------------------------------
    |
    | Previous versions of Livewire supported binding directly to eloquent model
    | properties using wire:model by default. However, this behavior has been
    | deemed too "magical" and has therefore been put under a feature flag.
    |
    */

    'legacy_model_binding' => true,

    /*
    |---------------------------------------------------------------------------
    | Auto-inject Frontend Assets
    |---------------------------------------------------------------------------
    |
    | By default, Livewire automatically injects its JavaScript and CSS into the
    | <head> and <body> of pages containing Livewire components. By disabling
    | this behavior, you need to use @livewireStyles and @livewireScripts.
    |
    */

    'inject_assets' => true,

    /*
    |---------------------------------------------------------------------------
    | Navigate (SPA mode)
    |---------------------------------------------------------------------------
    |
    | By adding `wire:navigate` to links in your Livewire application, Livewire
    | will prevent the default link handling and instead request those pages
    | via AJAX, creating an SPA-like effect. Configure this behavior here.
    |
    */

    'navigate' => [
        'show_progress_bar' => true,
        'progress_bar_color' => '#2299dd',
    ],

    /*
    |---------------------------------------------------------------------------
    | HTML Morph Markers
    |---------------------------------------------------------------------------
    |
    | Livewire intelligently "morphs" existing HTML into the newly rendered HTML
    | after each update. To make this process more reliable, Livewire injects
    | "markers" into the rendered Blade surrounding @if, @class & @foreach.
    |
    */

    'inject_morph_markers' => true,

    /*
    |---------------------------------------------------------------------------
    | Pagination Theme
    |---------------------------------------------------------------------------
    |
    | When enabling Livewire's pagination feature by using the `WithPagination`
    | trait, Livewire will use Tailwind templates to render pagination views
    | on the page. If you want Bootstrap CSS, you can specify: "bootstrap"
    |
    */

    'pagination_theme' => 'tailwind',
];

```


---

**File:** `./config/logging.php`

```php
<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\Processor\PsrLogMessageProcessor;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Deprecations Log Channel
    |--------------------------------------------------------------------------
    |
    | This option controls the log channel that should be used to log warnings
    | regarding deprecated PHP and library features. This allows you to get
    | your application ready for upcoming major versions of dependencies.
    |
    */

    'deprecations' => [
        'channel' => env('LOG_DEPRECATIONS_CHANNEL', 'null'),
        'trace' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['single'],
            'ignore_exceptions' => false,
            'replace_placeholders' => true,
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'replace_placeholders' => true,
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 14,
            'replace_placeholders' => true,
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Laravel Log',
            'emoji' => ':boom:',
            'level' => env('LOG_LEVEL', 'critical'),
            'replace_placeholders' => true,
        ],

        'papertrail' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => env('LOG_PAPERTRAIL_HANDLER', SyslogUdpHandler::class),
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
                'connectionString' => 'tls://'.env('PAPERTRAIL_URL').':'.env('PAPERTRAIL_PORT'),
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'stderr' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => env('LOG_LEVEL', 'debug'),
            'facility' => LOG_USER,
            'replace_placeholders' => true,
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => env('LOG_LEVEL', 'debug'),
            'replace_placeholders' => true,
        ],

        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],

        'emergency' => [
            'path' => storage_path('logs/laravel.log'),
        ],
    ],

];

```


---

**File:** `./config/lunar/cart.php`

```php
<?php

use Lunar\Actions\Carts\GenerateFingerprint;

return [
    /*
    |--------------------------------------------------------------------------
    | Fingerprint Generator
    |--------------------------------------------------------------------------
    |
    | Specify which class should be used when generating a cart fingerprint.
    |
    */
    'fingerprint_generator' => GenerateFingerprint::class,

    /*
    |--------------------------------------------------------------------------
    | Authentication policy
    |--------------------------------------------------------------------------
    |
    | When a user logs in, by default, Lunar will merge the current (guest) cart
    | with the users current cart, if they have one.
    | Available options: 'merge', 'override'
    |
    */
    'auth_policy' => 'merge',

    /*
    |--------------------------------------------------------------------------
    | Cart Pipelines
    |--------------------------------------------------------------------------
    |
    | Define which pipelines should be run when performing cart calculations.
    | The default ones provided should suit most needs, however you are
    | free to add your own as you see fit.
    |
    | Each pipeline class will be run from top to bottom.
    |
    */
    'pipelines' => [
        /*
         * Run these pipelines when the cart is calculating.
        */
        'cart' => [
            Lunar\Pipelines\Cart\CalculateLines::class,
            Lunar\Pipelines\Cart\ApplyShipping::class,
            Lunar\Pipelines\Cart\ApplyDiscounts::class,
            Lunar\Pipelines\Cart\CalculateTax::class,
            Lunar\Pipelines\Cart\Calculate::class,
        ],

        /*
         * Run these pipelines when the cart lines are being calculated.
        */
        'cart_lines' => [
            Lunar\Pipelines\CartLine\GetUnitPrice::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Cart Actions
    |--------------------------------------------------------------------------
    |
    | Here you can decide what action should be run during a Carts lifecycle.
    | The default actions should be fine for most cases.
    |
    */
    'actions' => [
        'add_to_cart' => Lunar\Actions\Carts\AddOrUpdatePurchasable::class,
        'get_existing_cart_line' => Lunar\Actions\Carts\GetExistingCartLine::class,
        'update_cart_line' => Lunar\Actions\Carts\UpdateCartLine::class,
        'remove_from_cart' => Lunar\Actions\Carts\RemovePurchasable::class,
        'add_address' => Lunar\Actions\Carts\AddAddress::class,
        'set_shipping_option' => Lunar\Actions\Carts\SetShippingOption::class,
        'order_create' => Lunar\Actions\Carts\CreateOrder::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Cart Action Validators
    |--------------------------------------------------------------------------
    |
    | You may wish to provide additional validation when actions executed on
    | the cart model. The defaults provided should be enough for most cases.
    |
    */
    'validators' => [

        'add_to_cart' => [
            Lunar\Validation\CartLine\CartLineQuantity::class,
            Lunar\Validation\CartLine\CartLineStock::class,
        ],

        'update_cart_line' => [
            Lunar\Validation\CartLine\CartLineQuantity::class,
            Lunar\Validation\CartLine\CartLineStock::class,
        ],

        'remove_from_cart' => [],

        'set_shipping_option' => [
            Lunar\Validation\Cart\ShippingOptionValidator::class,
        ],

        'order_create' => [
            Lunar\Validation\Cart\ValidateCartForOrderCreation::class,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Default eager loading
    |--------------------------------------------------------------------------
    |
    | When loading up a cart and doing calculations, there's a few relationships
    | that are used when it's running. Here you can define which relationships
    | should be eager loaded when these calculations take place.
    |
    */
    'eager_load' => [
        'currency',
        'lines.purchasable.taxClass',
        'lines.purchasable.values',
        'lines.purchasable.product.thumbnail',
        'lines.purchasable.prices.currency',
        'lines.purchasable.prices.priceable',
        'lines.purchasable.product',
        'lines.cart.currency',
    ],

    /*
    |--------------------------------------------------------------------------
    | Prune carts
    |--------------------------------------------------------------------------
    |
    | Should the cart models be pruned to prevent data build up and
    | some settings controlling how pruning should be determined
    |
    */
    'prune_tables' => [

        'enabled' => false,

        'pipelines' => [
            Lunar\Pipelines\CartPrune\PruneAfter::class,
            Lunar\Pipelines\CartPrune\WithoutOrders::class,
            Lunar\Pipelines\CartPrune\WhereNotMerged::class,
        ],

        'prune_interval' => 90, // days

    ],
];

```


---

**File:** `./config/lunar/cart_session.php`

```php
<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Session Key
    |--------------------------------------------------------------------------
    |
    | Specify the session key used when fetching the cart.
    |
    */
    'session_key' => 'lunar_cart',

    /*
    |--------------------------------------------------------------------------
    | Auto create a cart when none exists for user.
    |--------------------------------------------------------------------------
    |
    | Determines whether you want to automatically create a cart for a user if
    | they do not currently have one in the session. By default, this is false
    | to minimise the amount of carts added to the database.
    |
    */
    'auto_create' => false,

    /*
    |--------------------------------------------------------------------------
    | Allow Carts to have multiple orders associated.
    |--------------------------------------------------------------------------
    |
    | Determines whether the same cart instance will be returned if there is already
    | a completed order associated to the cart which is retrieved in the session.
    | When set to false, if a cart has a completed order, then a new instance
    | of a cart will be returned, even if auto_create is set to false
    |
    */
    'allow_multiple_orders_per_cart' => false,

    /*
    |--------------------------------------------------------------------------
    | Delete cart on logout
    |--------------------------------------------------------------------------
    |
    | Determines whether the cart sholud be soft deleted when the user logs out.
    |
    */
    'delete_on_forget' => true,
];

```


---

**File:** `./config/lunar/database.php`

```php
<?php

return [

    'connection' => null,

    'table_prefix' => 'lunar_',

    /*
    |--------------------------------------------------------------------------
    | Morph Prefix
    |--------------------------------------------------------------------------
    |
    | If you wish to prefix Lunar's morph mapping in the database, you can
    | set that here e.g. `lunar_product` instead of `product`
    |
    */
    'morph_prefix' => null,

    /*
    |--------------------------------------------------------------------------
    | Users Table ID
    |--------------------------------------------------------------------------
    |
    | Lunar adds a relationship to your 'users' table and by default assumes
    | a 'bigint'. You can change this to either an 'int' or 'uuid'.
    |
    */
    'users_id_type' => 'bigint',

    /*
    |--------------------------------------------------------------------------
    | Disable migrations
    |--------------------------------------------------------------------------
    |
    | Prevent Lunar`s default package migrations from running for the core.
    | Set to 'true' to disable.
    |
    */
    'disable_migrations' => false,

];

```


---

**File:** `./config/lunar/discounts.php`

```php
<?php

use Lunar\Base\Validation\CouponValidator;

return [

    /*
    |--------------------------------------------------------------------------
    | Coupon Validator
    |--------------------------------------------------------------------------
    |
    | Here you can specify the class which validates coupons. This is useful if you
    | want to have custom logic for what determines whether a coupon can be used.
    |
    */
    'coupon_validator' => CouponValidator::class,

];

```


---

**File:** `./config/lunar/media.php`

```php
<?php

use Lunar\Base\StandardMediaDefinitions;

return [

    'definitions' => [
        'asset' => StandardMediaDefinitions::class,
        'brand' => StandardMediaDefinitions::class,
        'collection' => StandardMediaDefinitions::class,
        'product' => StandardMediaDefinitions::class,
        'product-option' => StandardMediaDefinitions::class,
        'product-option-value' => StandardMediaDefinitions::class,
    ],

    'collection' => 'images',

    'fallback' => [
        'url' => env('FALLBACK_IMAGE_URL', null),
        'path' => env('FALLBACK_IMAGE_PATH', null),
    ],

];

```


---

**File:** `./config/lunar/orders.php`

```php
<?php

use Lunar\Base\OrderReferenceGenerator;

return [
    /*
    |--------------------------------------------------------------------------
    | Order Reference Format
    |--------------------------------------------------------------------------
    |
    | Specify the format for the order reference generator to use.
    |
    */
    'reference_format' => [
        /**
         * Optional prefix for the order reference
         */
        'prefix' => null,

        /**
         * STR_PAD_LEFT: 00001965
         * STR_PAD_RIGHT: 19650000
         * STR_PAD_BOTH: 00196500
         */
        'padding_direction' => STR_PAD_LEFT,

        /**
         * 00001965
         * AAAA1965
         */
        'padding_character' => '0',

        /**
         * If the length specified below is smaller than the length
         * of the Order ID, then no padding will take place.
         */
        'length' => 8,
    ],

    /*
    |--------------------------------------------------------------------------
    | Order Reference Generator
    |--------------------------------------------------------------------------
    |
    | Here you can specify how you want your order references to be generated
    | when you create an order from a cart.
    |
    */
    'reference_generator' => OrderReferenceGenerator::class,

    /*
    |--------------------------------------------------------------------------
    | Draft Status
    |--------------------------------------------------------------------------
    |
    | When a draft order is created from a cart, we need an initial status for
    | the order that's created. Define that here, it can be anything that would
    | make sense for the store you're building.
    |
    */
    'draft_status' => 'awaiting-payment',

    'statuses' => [

        'awaiting-payment' => [
            'label' => 'Awaiting Payment',
            'color' => '#848a8c',
            'mailers' => [],
            'notifications' => [],
            'favourite' => true,
        ],

        'payment-offline' => [
            'label' => 'Payment Offline',
            'color' => '#0A81D7',
            'mailers' => [],
            'notifications' => [],
            'favourite' => true,
        ],

        'payment-received' => [
            'label' => 'Payment Received',
            'color' => '#6a67ce',
            'mailers' => [],
            'notifications' => [],
            'favourite' => true,
        ],

        'dispatched' => [
            'label' => 'Dispatched',
            'mailers' => [],
            'notifications' => [],
            'favourite' => true,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Order Pipelines
    |--------------------------------------------------------------------------
    |
    | Define which pipelines should be run throughout an order's lifecycle.
    | The default ones provided should suit most needs, however you are
    | free to add your own as you see fit.
    |
    | Each pipeline class will be run from top to bottom.
    |
    */
    'pipelines' => [
        'creation' => [
            Lunar\Pipelines\Order\Creation\FillOrderFromCart::class,
            Lunar\Pipelines\Order\Creation\CreateOrderLines::class,
            Lunar\Pipelines\Order\Creation\CreateOrderAddresses::class,
            Lunar\Pipelines\Order\Creation\CreateShippingLine::class,
            Lunar\Pipelines\Order\Creation\CleanUpOrderLines::class,
            Lunar\Pipelines\Order\Creation\MapDiscountBreakdown::class,
        ],
    ],

];

```


---

**File:** `./config/lunar/panel.php`

```php
<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Enable Variants
    |--------------------------------------------------------------------------
    |
    | When `true` this will show the Variants manager when editing a product. If your
    | storefront doesn't support variants, set this to false.
    |
    */
    'enable_variants' => true,

    /*
    |--------------------------------------------------------------------------
    | PDF Streaming
    |--------------------------------------------------------------------------
    |
    | When handling PDF's in the panel, you can decide whether to stream the PDF in
    | a new tab or download the PDF to your hard drive.
    |
    | Available options are 'download' or 'stream'
    |
    */
    'pdf_rendering' => 'download',

    /*
    |--------------------------------------------------------------------------
    | Enable Scout when searching on supported models.
    |--------------------------------------------------------------------------
    |
    | Some models in the core have Scout implemented as a search driver, if you
    | want to use Scout when possible on tables in the panel, enable it here.
    |
    */
    'scout_enabled' => false,

    /*
    |--------------------------------------------------------------------------
    | Navigation counts
    |--------------------------------------------------------------------------
    |
    | The admin panel will show a count of orders in the left navigation.
    | This is based upon specific order statuses. You can define the statuses
    | to include in the count below.
    |
    */
    'order_count_statuses' => ['payment-received'],

];

```


---

**File:** `./config/lunar/payments.php`

```php
<?php

return [

    'default' => env('PAYMENTS_TYPE', 'cash-in-hand'),

    'types' => [
        'cash-in-hand' => [
            'driver' => 'offline',
            'authorized' => 'payment-offline',
        ],
    ],

];

```


---

**File:** `./config/lunar/pricing.php`

```php
<?php

use Lunar\Pricing\DefaultPriceFormatter;

return [

    /*
    |--------------------------------------------------------------------------
    | Pricing Stored Inclusive of Tax
    |--------------------------------------------------------------------------
    |
    | Specify whether the prices entered into the system include tax or not.
    |
    */
    'stored_inclusive_of_tax' => env('LUNAR_STORE_INCLUSIVE_OF_TAX', false),

    /*
    |--------------------------------------------------------------------------
    | Price formatter
    |--------------------------------------------------------------------------
    |
    | Specify which class to use when formatting price data types
    |
    */
    'formatter' => DefaultPriceFormatter::class,

    /*
    |--------------------------------------------------------------------------
    | Pricing Pipelines
    |--------------------------------------------------------------------------
    |
    | Define which pipelines should be run when retrieving purchasable price.
    |
    | Each pipeline class will be run from top to bottom.
    |
    */
    'pipelines' => [
        // App\Pipelines\Pricing\Example::class,
    ],

];

```


---

**File:** `./config/lunar/products.php`

```php
<?php

return [
    'association_types_enum' => \Lunar\Base\Enums\ProductAssociation::class,
];

```


---

**File:** `./config/lunar/search.php`

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Models for indexing
    |--------------------------------------------------------------------------
    |
    | The model listed here will be used to create/populate the indexes.
    | You can provide your own model here to run them all on the same
    | search engine.
    |
    */
    'models' => [
        /*
         * These models are required by the system, do not change them.
         */
        Lunar\Models\Brand::class,
        Lunar\Models\Collection::class,
        Lunar\Models\Customer::class,
        Lunar\Models\Order::class,
        Lunar\Models\Product::class,
        Lunar\Models\ProductOption::class,

        /*
         * Below you can add your own models for indexing...
         */
        // App\Models\Example::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Search engine mapping
    |--------------------------------------------------------------------------
    |
    | You can define what search driver each searchable model should use.
    | If the model isn't defined here, it will use the SCOUT_DRIVER env variable.
    |
    */
    'engine_map' => [
        // Lunar\Models\Product::class => 'algolia',
        // Lunar\Models\Order::class => 'meilisearch',
        // Lunar\Models\Collection::class => 'meilisearch',
    ],

    'indexers' => [
        Lunar\Models\Brand::class => Lunar\Search\BrandIndexer::class,
        Lunar\Models\Collection::class => Lunar\Search\CollectionIndexer::class,
        Lunar\Models\Customer::class => Lunar\Search\CustomerIndexer::class,
        Lunar\Models\Order::class => Lunar\Search\OrderIndexer::class,
        Lunar\Models\Product::class => Lunar\Search\ProductIndexer::class,
        Lunar\Models\ProductOption::class => Lunar\Search\ProductOptionIndexer::class,
    ],

];

```


---

**File:** `./config/lunar/shipping.php`

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Measurements
    |--------------------------------------------------------------------------
    |
    | You can use any measurements available at
    | https://github.com/cartalyst/converter/edit/master/src/config/config.php
    |
    */
    'measurements' => [

        'length' => [

            'm' => [
                'format' => '1,0.000 m',
                'unit' => 1.00,
            ],

            'mm' => [
                'format' => '1,0.000 mm',
                'unit' => 1000,
            ],

            'cm' => [
                'format' => '1!0 cm',
                'unit' => 100,
            ],

            'ft' => [
                'format' => '1,0.00 ft.',
                'unit' => 3.28084,
            ],

            'in' => [
                'format' => '1,0.00 in.',
                'unit' => 39.3701,
            ],

        ],

        'area' => [

            'sqm' => [
                'format' => '1,00.00 sq m',
                'unit' => 1,
            ],

        ],

        'weight' => [

            'kg' => [
                'format' => '1,0.00 kg',
                'unit' => 1.00,
            ],

            'g' => [
                'format' => '1,0.00 g',
                'unit' => 1000.00,
            ],

            'lbs' => [
                'format' => '1,0.00 lbs',
                'unit' => 2.20462,
            ],

        ],

        'volume' => [

            'l' => [
                'format' => '1,00.00l',
                'unit' => 1,
            ],

            'ml' => [
                'format' => '1,00.000ml',
                'unit' => 1000,
            ],

            'gal' => [
                'format' => '1,00.000gal',
                'unit' => 0.264172,
            ],

            'floz' => [
                'format' => '1,00.000Fl oz.',
                'unit' => 33.814,
            ],

        ],

    ],

];

```


---

**File:** `./config/lunar/stripe.php`

```php
<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Webhook path
    |--------------------------------------------------------------------------
    |
    | Set what the path should be for the webhook you set up in Stripe.
    |
    */
    'webhook_path' => 'stripe/webhook',

    /*
    |--------------------------------------------------------------------------
    | Capture policy
    |--------------------------------------------------------------------------
    |
    | Here is where you can set whether you want to capture and charge payments
    | straight away, or create the Payment Intent and release them at a later date.
    |
    | automatic - Capture the payment straight away.
    | manual - Don't take payment straight away and capture later.
    |
    */
    'policy' => 'automatic',

    /*
    |--------------------------------------------------------------------------
    | Sync addresses
    |--------------------------------------------------------------------------
    |
    | When enabled, the Stripe addon will attempt to sync the billing and shipping
    | addresses which have been stored against the payment intent on Stripe.
    | This is useful when you don't always get the full address during the
    | checkout process, which can be the case when using express checkout.
    |
    */
    'sync_addresses' => true,

    /*
    |--------------------------------------------------------------------------
    | Status mapping
    |--------------------------------------------------------------------------
    |
    | When a payment intent is retrieved from Stripe it will have a status which is
    | unique to Stripe and potentially not what you have in Lunar. Here you can define
    | what each Stripe status should be in Lunar.
    |
    | Reference: https://stripe.com/docs/api/charges/object
    */
    'status_mapping' => [
        \Stripe\PaymentIntent::STATUS_REQUIRES_CAPTURE => 'requires-capture',
        \Stripe\PaymentIntent::STATUS_CANCELED => 'cancelled',
        \Stripe\PaymentIntent::STATUS_PROCESSING => 'processing',
        \Stripe\PaymentIntent::STATUS_REQUIRES_ACTION => 'awaiting-payment',
        \Stripe\PaymentIntent::STATUS_REQUIRES_CONFIRMATION => 'auth-pending',
        \Stripe\PaymentIntent::STATUS_REQUIRES_PAYMENT_METHOD => 'failed',
        \Stripe\PaymentIntent::STATUS_SUCCEEDED => 'payment-received',
    ],

    'actions' => [
        /*
        |--------------------------------------------------------------------------
        | Store charges
        |--------------------------------------------------------------------------
        |
        | A payment intent might have a number of charges associated to them, these
        | could be either pending, captured or refunds. This action takes the charges
        | which are associated to the payment intent and stores them against the order.
        |
        | Reference: https://stripe.com/docs/api/charges/object
        */
        'store_charges' => \Lunar\Stripe\Actions\StoreCharges::class,
    ],
];

```


---

**File:** `./config/lunar/taxes.php`

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Tax Driver
    |--------------------------------------------------------------------------
    |
    | Here you can specify which tax driver should be used. By default system is used
    | and should work for you in most cases.
    |
    */
    'driver' => 'system',

];

```


---

**File:** `./config/lunar/urls.php`

```php
<?php

use Lunar\Generators\UrlGenerator;

return [

    /*
    | Set whether URLs should be required across the system. Setting this as true
    | will affect how validation works when creating/editing products in the hub.
    |
    | If you have a generator specified below, this setting will have no effect
    | on validation rules across the system.
    */
    'required' => true,

    /*
    |--------------------------------------------------------------------------
    | URL Generator
    |--------------------------------------------------------------------------
    |
    | Here you can specify a class to automatically generate URLs for models which
    | implement the `HasUrls` trait. If left null no generation will happen.
    | You are free to use your own generator, or you can use the one that
    | ships with Lunar, which by default will use the name attribute.
    |
    */
    'generator' => UrlGenerator::class,

];

```


---

**File:** `./config/mail.php`

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | This option controls the default mailer that is used to send any email
    | messages sent by your application. Alternative mailers may be setup
    | and used as needed; however, this mailer will be used by default.
    |
    */

    'default' => env('MAIL_MAILER', 'smtp'),

    /*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    |
    | Here you may configure all of the mailers used by your application plus
    | their respective settings. Several examples have been configured for
    | you and you are free to add your own as your application requires.
    |
    | Laravel supports a variety of mail "transport" drivers to be used while
    | sending an e-mail. You will specify which one you are using for your
    | mailers below. You are free to add additional mailers as required.
    |
    | Supported: "smtp", "sendmail", "mailgun", "ses", "ses-v2",
    |            "postmark", "log", "array", "failover", "roundrobin"
    |
    */

    'mailers' => [
        'smtp' => [
            'transport' => 'smtp',
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
        ],

        'ses' => [
            'transport' => 'ses',
        ],

        'mailgun' => [
            'transport' => 'mailgun',
        ],

        'postmark' => [
            'transport' => 'postmark',
        ],

        'sendmail' => [
            'transport' => 'sendmail',
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i'),
        ],

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        'array' => [
            'transport' => 'array',
        ],

        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
        ],

        'roundrobin' => [
            'transport' => 'roundrobin',
            'mailers' => [
                'ses',
                'postmark',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    |
    | You may wish for all e-mails sent by your application to be sent from
    | the same address. Here, you may specify a name and address that is
    | used globally for all e-mails that are sent by your application.
    |
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Markdown Mail Settings
    |--------------------------------------------------------------------------
    |
    | If you are using Markdown based email rendering, you may configure your
    | theme and component paths here, allowing you to customize the design
    | of the emails. Or, you may simply stick with the Laravel defaults!
    |
    */

    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],

];

```


---

**File:** `./config/mcp.php`

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Redirect Domains
    |--------------------------------------------------------------------------
    |
    | These domains are the domains that OAuth clients are permitted to use
    | for redirect URIs. Each domain should be specified with its scheme
    | and host. Domains not in this list will raise validation errors.
    |
    | An "*" may be used to allow all domains.
    |
    */

    'redirect_domains' => [
        '*',
        // 'https://example.com',
    ],

];

```


---

**File:** `./config/media-library.php`

```php
<?php

return [

    /*
     * The disk on which to store added files and derived images by default. Choose
     * one or more of the disks you've configured in config/filesystems.php.
     */
    'disk_name' => env('MEDIA_DISK', 'public'),

    /*
     * The maximum file size of an item in bytes.
     * Adding a larger file will result in an exception.
     */
    'max_file_size' => 1024 * 1024 * 10, // 10MB

    /*
     * This queue will be used to generate derived and responsive images.
     * Leave empty to use the default queue.
     */
    'queue_name' => '',

    /*
     * By default all conversions will be performed on a queue.
     */
    'queue_conversions_by_default' => env('QUEUE_CONVERSIONS_BY_DEFAULT', true),

    /*
     * The fully qualified class name of the media model.
     */
    'media_model' => Spatie\MediaLibrary\MediaCollections\Models\Media::class,

    /*
     * The fully qualified class name of the model used for temporary uploads.
     *
     * This model is only used in Media Library Pro (https://medialibrary.pro)
     */
    'temporary_upload_model' => Spatie\MediaLibraryPro\Models\TemporaryUpload::class,

    /*
     * When enabled, Media Library Pro will only process temporary uploads there were uploaded
     * in the same session. You can opt to disable this for stateless usage of
     * the pro components.
     */
    'enable_temporary_uploads_session_affinity' => true,

    /*
     * When enabled, Media Library pro will generate thumbnails for uploaded file.
     */
    'generate_thumbnails_for_temporary_uploads' => true,

    /*
     * This is the class that is responsible for naming generated files.
     */
    'file_namer' => Spatie\MediaLibrary\Support\FileNamer\DefaultFileNamer::class,

    /*
     * The class that contains the strategy for determining a media file's path.
     */
    'path_generator' => \Spatie\MediaLibrary\Support\PathGenerator\DefaultPathGenerator::class,

    /*
     * When urls to files get generated, this class will be called. Use the default
     * if your files are stored locally above the site root or on s3.
     */
    'url_generator' => Spatie\MediaLibrary\Support\UrlGenerator\DefaultUrlGenerator::class,

    /*
     * Moves media on updating to keep path consistent. Enable it only with a custom
     * PathGenerator that uses, for example, the media UUID.
     */
    'moves_media_on_update' => false,

    /*
     * Whether to activate versioning when urls to files get generated.
     * When activated, this attaches a ?v=xx query string to the URL.
     */
    'version_urls' => false,

    /*
     * The media library will try to optimize all converted images by removing
     * metadata and applying a little bit of compression. These are
     * the optimizers that will be used by default.
     */
    'image_optimizers' => [
        Spatie\ImageOptimizer\Optimizers\Jpegoptim::class => [
            '-m85', // set maximum quality to 85%
            '--force', // ensure that progressive generation is always done also if a little bigger
            '--strip-all', // this strips out all text information such as comments and EXIF data
            '--all-progressive', // this will make sure the resulting image is a progressive one
        ],
        Spatie\ImageOptimizer\Optimizers\Pngquant::class => [
            '--force', // required parameter for this package
        ],
        Spatie\ImageOptimizer\Optimizers\Optipng::class => [
            '-i0', // this will result in a non-interlaced, progressive scanned image
            '-o2', // this set the optimization level to two (multiple IDAT compression trials)
            '-quiet', // required parameter for this package
        ],
        Spatie\ImageOptimizer\Optimizers\Svgo::class => [
            '--disable=cleanupIDs', // disabling because it is known to cause troubles
        ],
        Spatie\ImageOptimizer\Optimizers\Gifsicle::class => [
            '-b', // required parameter for this package
            '-O3', // this produces the slowest but best results
        ],
        Spatie\ImageOptimizer\Optimizers\Cwebp::class => [
            '-m 6', // for the slowest compression method in order to get the best compression.
            '-pass 10', // for maximizing the amount of analysis pass.
            '-mt', // multithreading for some speed improvements.
            '-q 90', //quality factor that brings the least noticeable changes.
        ],
    ],

    /*
     * These generators will be used to create an image of media files.
     */
    'image_generators' => [
        Spatie\MediaLibrary\Conversions\ImageGenerators\Image::class,
        Spatie\MediaLibrary\Conversions\ImageGenerators\Webp::class,
        Spatie\MediaLibrary\Conversions\ImageGenerators\Pdf::class,
        Spatie\MediaLibrary\Conversions\ImageGenerators\Svg::class,
        Spatie\MediaLibrary\Conversions\ImageGenerators\Video::class,
    ],

    /*
     * The path where to store temporary files while performing image conversions.
     * If set to null, storage_path('media-library/temp') will be used.
     */
    'temporary_directory_path' => null,

    /*
     * The engine that should perform the image conversions.
     * Should be either `gd` or `imagick`.
     */
    'image_driver' => env('IMAGE_DRIVER', 'gd'),

    /*
     * FFMPEG & FFProbe binaries paths, only used if you try to generate video
     * thumbnails and have installed the php-ffmpeg/php-ffmpeg composer
     * dependency.
     */
    'ffmpeg_path' => env('FFMPEG_PATH', '/usr/bin/ffmpeg'),
    'ffprobe_path' => env('FFPROBE_PATH', '/usr/bin/ffprobe'),

    /*
     * Here you can override the class names of the jobs used by this package. Make sure
     * your custom jobs extend the ones provided by the package.
     */
    'jobs' => [
        'perform_conversions' => Spatie\MediaLibrary\Conversions\Jobs\PerformConversionsJob::class,
        'generate_responsive_images' => Spatie\MediaLibrary\ResponsiveImages\Jobs\GenerateResponsiveImagesJob::class,
    ],

    /*
     * When using the addMediaFromUrl method you may want to replace the default downloader.
     * This is particularly useful when the url of the image is behind a firewall and
     * need to add additional flags, possibly using curl.
     */
    'media_downloader' => Spatie\MediaLibrary\Downloaders\DefaultDownloader::class,

    'remote' => [
        /*
         * Any extra headers that should be included when uploading media to
         * a remote disk. Even though supported headers may vary between
         * different drivers, a sensible default has been provided.
         *
         * Supported by S3: CacheControl, Expires, StorageClass,
         * ServerSideEncryption, Metadata, ACL, ContentEncoding
         */
        'extra_headers' => [
            'CacheControl' => 'max-age=604800',
        ],
    ],

    'responsive_images' => [
        /*
         * This class is responsible for calculating the target widths of the responsive
         * images. By default we optimize for filesize and create variations that each are 20%
         * smaller than the previous one. More info in the documentation.
         *
         * https://docs.spatie.be/laravel-medialibrary/v9/advanced-usage/generating-responsive-images
         */
        'width_calculator' => Spatie\MediaLibrary\ResponsiveImages\WidthCalculator\FileSizeOptimizedWidthCalculator::class,

        /*
         * By default rendering media to a responsive image will add some javascript and a tiny placeholder.
         * This ensures that the browser can already determine the correct layout.
         */
        'use_tiny_placeholders' => true,

        /*
         * This class will generate the tiny placeholder used for progressive image loading. By default
         * the media library will use a tiny blurred jpg image.
         */
        'tiny_placeholder_generator' => Spatie\MediaLibrary\ResponsiveImages\TinyPlaceholderGenerator\Blurred::class,
    ],

    /*
     * When enabling this option, a route will be registered that will enable
     * the Media Library Pro Vue and React components to move uploaded files
     * in a S3 bucket to their right place.
     */
    'enable_vapor_uploads' => env('ENABLE_MEDIA_LIBRARY_VAPOR_UPLOADS', false),

    /*
     * When converting Media instances to response the media library will add
     * a `loading` attribute to the `img` tag. Here you can set the default
     * value of that attribute.
     *
     * Possible values: 'lazy', 'eager', 'auto' or null if you don't want to set any loading instruction.
     *
     * More info: https://css-tricks.com/native-lazy-loading/
     */
    'default_loading_attribute_value' => null,

    /*
     * You can specify a prefix for that is used for storing all media.
     * If you set this to `/my-subdir`, all your media will be stored in a `/my-subdir` directory.
     */
    'prefix' => env('MEDIA_PREFIX', ''),
];

```


---

**File:** `./config/passkeys.php`

```php
<?php

return [
    /*
     * After a successful authentication attempt using a passkey
     * we'll redirect to this URL.
     */
    'redirect_to_after_login' => '/dashboard',

    /*
     * These class are responsible for performing core tasks regarding passkeys.
     * You can customize them by creating a class that extends the default, and
     * by specifying your custom class name here.
     */
    'actions' => [
        'generate_passkey_register_options' => Spatie\LaravelPasskeys\Actions\GeneratePasskeyRegisterOptionsAction::class,
        'store_passkey' => Spatie\LaravelPasskeys\Actions\StorePasskeyAction::class,
        'generate_passkey_authentication_options' => \Spatie\LaravelPasskeys\Actions\GeneratePasskeyAuthenticationOptionsAction::class,
        'find_passkey' => Spatie\LaravelPasskeys\Actions\FindPasskeyToAuthenticateAction::class,
        'configure_ceremony_step_manager_factory' => Spatie\LaravelPasskeys\Actions\ConfigureCeremonyStepManagerFactoryAction::class,
    ],

    /*
     * These properties will be used to generate the passkey.
     */
    'relying_party' => [
        'name' => config('app.name'),
        'id' => parse_url(config('app.url'), PHP_URL_HOST),
        'icon' => null,
    ],

    /*
     * The models used by the package.
     *
     * You can override this by specifying your own models
     */
    'models' => [
        'passkey' => Spatie\LaravelPasskeys\Models\Passkey::class,
        'authenticatable' => env('AUTH_MODEL', App\Models\User::class),
    ],
];

```


---

**File:** `./config/permission.php`

```php
<?php

return [

    'models' => [

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your permissions. Of course, it
         * is often just the "Permission" model but you may use whatever you like.
         *
         * The model you want to use as a Permission model needs to implement the
         * `Spatie\Permission\Contracts\Permission` contract.
         */

        'permission' => Spatie\Permission\Models\Permission::class,

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your roles. Of course, it
         * is often just the "Role" model but you may use whatever you like.
         *
         * The model you want to use as a Role model needs to implement the
         * `Spatie\Permission\Contracts\Role` contract.
         */

        'role' => Spatie\Permission\Models\Role::class,

    ],

    'table_names' => [

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'roles' => 'roles',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your permissions. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'permissions' => 'permissions',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your models permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_permissions' => 'model_has_permissions',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your models roles. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_roles' => 'model_has_roles',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'role_has_permissions' => 'role_has_permissions',
    ],

    'column_names' => [
        /*
         * Change this if you want to name the related pivots other than defaults
         */
        'role_pivot_key' => null, //default 'role_id',
        'permission_pivot_key' => null, //default 'permission_id',

        /*
         * Change this if you want to name the related model primary key other than
         * `model_id`.
         *
         * For example, this would be nice if your primary keys are all UUIDs. In
         * that case, name this `model_uuid`.
         */

        'model_morph_key' => 'model_id',

        /*
         * Change this if you want to use the teams feature and your related model's
         * foreign key is other than `team_id`.
         */

        'team_foreign_key' => 'team_id',
    ],

    /*
     * When set to true, the method for checking permissions will be registered on the gate.
     * Set this to false, if you want to implement custom logic for checking permissions.
     */

    'register_permission_check_method' => true,

    /*
     * When set to true the package implements teams using the 'team_foreign_key'. If you want
     * the migrations to register the 'team_foreign_key', you must set this to true
     * before doing the migration. If you already did the migration then you must make a new
     * migration to also add 'team_foreign_key' to 'roles', 'model_has_roles', and
     * 'model_has_permissions'(view the latest version of package's migration file)
     */

    'teams' => false,

    /*
     * When set to true, the required permission names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_permission_in_exception' => false,

    /*
     * When set to true, the required role names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_role_in_exception' => false,

    /*
     * By default wildcard permission lookups are disabled.
     */

    'enable_wildcard_permission' => false,

    'cache' => [

        /*
         * By default all permissions are cached for 24 hours to speed up performance.
         * When permissions or roles are updated the cache is flushed automatically.
         */

        'expiration_time' => \DateInterval::createFromDateString('24 hours'),

        /*
         * The cache key used to store all permissions.
         */

        'key' => 'spatie.permission.cache',

        /*
         * You may optionally indicate a specific cache driver to use for permission and
         * role caching using any of the `store` drivers listed in the cache.php config
         * file. Using 'default' here means to use the `default` set in cache.php.
         */

        'store' => 'default',
    ],
];

```


---

**File:** `./config/queue.php`

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Queue Connection Name
    |--------------------------------------------------------------------------
    |
    | Laravel's queue API supports an assortment of back-ends via a single
    | API, giving you convenient access to each back-end using the same
    | syntax for every one. Here you may define a default connection.
    |
    */

    'default' => env('QUEUE_CONNECTION', 'sync'),

    /*
    |--------------------------------------------------------------------------
    | Queue Connections
    |--------------------------------------------------------------------------
    |
    | Here you may configure the connection information for each server that
    | is used by your application. A default configuration has been added
    | for each back-end shipped with Laravel. You are free to add more.
    |
    | Drivers: "sync", "database", "beanstalkd", "sqs", "redis", "null"
    |
    */

    'connections' => [

        'sync' => [
            'driver' => 'sync',
        ],

        'database' => [
            'driver' => 'database',
            'table' => 'jobs',
            'queue' => 'default',
            'retry_after' => 90,
            'after_commit' => false,
        ],

        'beanstalkd' => [
            'driver' => 'beanstalkd',
            'host' => 'localhost',
            'queue' => 'default',
            'retry_after' => 90,
            'block_for' => 0,
            'after_commit' => false,
        ],

        'sqs' => [
            'driver' => 'sqs',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'prefix' => env('SQS_PREFIX', 'https://sqs.us-east-1.amazonaws.com/your-account-id'),
            'queue' => env('SQS_QUEUE', 'default'),
            'suffix' => env('SQS_SUFFIX'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'after_commit' => false,
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
            'queue' => env('REDIS_QUEUE', 'default'),
            'retry_after' => 90,
            'block_for' => null,
            'after_commit' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Failed Queue Jobs
    |--------------------------------------------------------------------------
    |
    | These options configure the behavior of failed queue job logging so you
    | can control which database and table are used to store the jobs that
    | have failed. You may change them to any database / table you wish.
    |
    */

    'failed' => [
        'driver' => env('QUEUE_FAILED_DRIVER', 'database-uuids'),
        'database' => env('DB_CONNECTION', 'mysql'),
        'table' => 'failed_jobs',
    ],

];

```


---

**File:** `./config/sanctum.php`

```php
<?php

use Laravel\Sanctum\Sanctum;

return [

    /*
    |--------------------------------------------------------------------------
    | Stateful Domains
    |--------------------------------------------------------------------------
    |
    | Requests from the following domains / hosts will receive stateful API
    | authentication cookies. Typically, these should include your local
    | and production domains which access your API via a frontend SPA.
    |
    */

    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
        '%s%s',
        'localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1',
        Sanctum::currentApplicationUrlWithPort()
    ))),

    /*
    |--------------------------------------------------------------------------
    | Sanctum Guards
    |--------------------------------------------------------------------------
    |
    | This array contains the authentication guards that will be checked when
    | Sanctum is trying to authenticate a request. If none of these guards
    | are able to authenticate the request, Sanctum will use the bearer
    | token that's present on an incoming request for authentication.
    |
    */

    'guard' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Expiration Minutes
    |--------------------------------------------------------------------------
    |
    | This value controls the number of minutes until an issued token will be
    | considered expired. If this value is null, personal access tokens do
    | not expire. This won't tweak the lifetime of first-party sessions.
    |
    */

    'expiration' => null,

    /*
    |--------------------------------------------------------------------------
    | Token Prefix
    |--------------------------------------------------------------------------
    |
    | Sanctum can prefix new tokens in order to take advantage of numerous
    | security scanning initiatives maintained by open source platforms
    | that notify developers if they commit tokens into repositories.
    |
    | See: https://docs.github.com/en/code-security/secret-scanning/about-secret-scanning
    |
    */

    'token_prefix' => env('SANCTUM_TOKEN_PREFIX', ''),

    /*
    |--------------------------------------------------------------------------
    | Sanctum Middleware
    |--------------------------------------------------------------------------
    |
    | When authenticating your first-party SPA with Sanctum you may need to
    | customize some of the middleware Sanctum uses while processing the
    | request. You may change the middleware listed below as required.
    |
    */

    'middleware' => [
        'authenticate_session' => Laravel\Sanctum\Http\Middleware\AuthenticateSession::class,
        'encrypt_cookies' => Illuminate\Cookie\Middleware\EncryptCookies::class,
        'validate_csrf_token' => Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
    ],

];

```


---

**File:** `./config/scout.php`

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Search Engine
    |--------------------------------------------------------------------------
    |
    | This option controls the default search connection that gets used while
    | using Laravel Scout. This connection is used when syncing all models
    | to the search service. You should adjust this based on your needs.
    |
    | Supported: "algolia", "collection", "null"
    |
    */

    'driver' => env('SCOUT_DRIVER', 'null'),

    /*
    |--------------------------------------------------------------------------
    | Index Prefix
    |--------------------------------------------------------------------------
    |
    | Here you may specify a prefix that will be applied to all search index
    | names used by Scout. This prefix may be useful if you have multiple
    | "tenants" or applications sharing the same search infrastructure.
    |
    */

    'prefix' => env('SCOUT_PREFIX', 'demo_store_'),

    /*
    |--------------------------------------------------------------------------
    | Queue Data Syncing
    |--------------------------------------------------------------------------
    |
    | This option allows you to control if the operations that sync your data
    | with your search engines are queued. When this is set to "true" then
    | all automatic data syncing will get queued for better performance.
    |
    */

    'queue' => env('SCOUT_QUEUE', false),

    /*
    |--------------------------------------------------------------------------
    | Database Transactions
    |--------------------------------------------------------------------------
    |
    | This configuration option determines if your data will only be synced
    | with your search indexes after every open database transaction has
    | been committed, thus preventing any discarded data from syncing.
    |
    */

    'after_commit' => false,

    /*
    |--------------------------------------------------------------------------
    | Chunk Sizes
    |--------------------------------------------------------------------------
    |
    | These options allow you to control the maximum chunk size when you are
    | mass importing data into the search engine. This allows you to fine
    | tune each of these chunk sizes based on the power of the servers.
    |
    */

    'chunk' => [
        'searchable' => 500,
        'unsearchable' => 500,
    ],

    /*
    |--------------------------------------------------------------------------
    | Soft Deletes
    |--------------------------------------------------------------------------
    |
    | This option allows to control whether to keep soft deleted records in
    | the search indexes. Maintaining soft deleted records can be useful
    | if your application still needs to search for the records later.
    |
    */

    'soft_delete' => false,

    /*
    |--------------------------------------------------------------------------
    | Identify User
    |--------------------------------------------------------------------------
    |
    | This option allows you to control whether to notify the search engine
    | of the user performing the search. This is sometimes useful if the
    | engine supports any analytics based on this application's users.
    |
    | Supported engines: "algolia"
    |
    */

    'identify' => env('SCOUT_IDENTIFY', false),

    /*
    |--------------------------------------------------------------------------
    | Algolia Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your Algolia settings. Algolia is a cloud hosted
    | search engine which works great with Scout out of the box. Just plug
    | in your application ID and admin API key to get started searching.
    |
    */

    'algolia' => [
        'id' => env('ALGOLIA_APP_ID', ''),
        'secret' => env('ALGOLIA_SECRET', ''),
    ],

];

```


---

**File:** `./config/services.php`

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'stripe' => [
        'public_key' => env('STRIPE_KEY'),
        'key' => env('STRIPE_SECRET'),
    ],

];

```


---

**File:** `./config/session.php`

```php
<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Session Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default session "driver" that will be used on
    | requests. By default, we will use the lightweight native driver but
    | you may specify any of the other wonderful drivers provided here.
    |
    | Supported: "file", "cookie", "database", "apc",
    |            "memcached", "redis", "dynamodb", "array"
    |
    */

    'driver' => env('SESSION_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | Session Lifetime
    |--------------------------------------------------------------------------
    |
    | Here you may specify the number of minutes that you wish the session
    | to be allowed to remain idle before it expires. If you want them
    | to immediately expire on the browser closing, set that option.
    |
    */

    'lifetime' => env('SESSION_LIFETIME', 120),

    'expire_on_close' => false,

    /*
    |--------------------------------------------------------------------------
    | Session Encryption
    |--------------------------------------------------------------------------
    |
    | This option allows you to easily specify that all of your session data
    | should be encrypted before it is stored. All encryption will be run
    | automatically by Laravel and you can use the Session like normal.
    |
    */

    'encrypt' => false,

    /*
    |--------------------------------------------------------------------------
    | Session File Location
    |--------------------------------------------------------------------------
    |
    | When using the native session driver, we need a location where session
    | files may be stored. A default has been set for you but a different
    | location may be specified. This is only needed for file sessions.
    |
    */

    'files' => storage_path('framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | Session Database Connection
    |--------------------------------------------------------------------------
    |
    | When using the "database" or "redis" session drivers, you may specify a
    | connection that should be used to manage these sessions. This should
    | correspond to a connection in your database configuration options.
    |
    */

    'connection' => env('SESSION_CONNECTION'),

    /*
    |--------------------------------------------------------------------------
    | Session Database Table
    |--------------------------------------------------------------------------
    |
    | When using the "database" session driver, you may specify the table we
    | should use to manage the sessions. Of course, a sensible default is
    | provided for you; however, you are free to change this as needed.
    |
    */

    'table' => 'sessions',

    /*
    |--------------------------------------------------------------------------
    | Session Cache Store
    |--------------------------------------------------------------------------
    |
    | While using one of the framework's cache driven session backends you may
    | list a cache store that should be used for these sessions. This value
    | must match with one of the application's configured cache "stores".
    |
    | Affects: "apc", "dynamodb", "memcached", "redis"
    |
    */

    'store' => env('SESSION_STORE'),

    /*
    |--------------------------------------------------------------------------
    | Session Sweeping Lottery
    |--------------------------------------------------------------------------
    |
    | Some session drivers must manually sweep their storage location to get
    | rid of old sessions from storage. Here are the chances that it will
    | happen on a given request. By default, the odds are 2 out of 100.
    |
    */

    'lottery' => [2, 100],

    /*
    |--------------------------------------------------------------------------
    | Session Cookie Name
    |--------------------------------------------------------------------------
    |
    | Here you may change the name of the cookie used to identify a session
    | instance by ID. The name specified here will get used every time a
    | new session cookie is created by the framework for every driver.
    |
    */

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug(env('APP_NAME', 'laravel'), '_').'_session'
    ),

    /*
    |--------------------------------------------------------------------------
    | Session Cookie Path
    |--------------------------------------------------------------------------
    |
    | The session cookie path determines the path for which the cookie will
    | be regarded as available. Typically, this will be the root path of
    | your application but you are free to change this when necessary.
    |
    */

    'path' => '/',

    /*
    |--------------------------------------------------------------------------
    | Session Cookie Domain
    |--------------------------------------------------------------------------
    |
    | Here you may change the domain of the cookie used to identify a session
    | in your application. This will determine which domains the cookie is
    | available to in your application. A sensible default has been set.
    |
    */

    'domain' => env('SESSION_DOMAIN'),

    /*
    |--------------------------------------------------------------------------
    | HTTPS Only Cookies
    |--------------------------------------------------------------------------
    |
    | By setting this option to true, session cookies will only be sent back
    | to the server if the browser has a HTTPS connection. This will keep
    | the cookie from being sent to you when it can't be done securely.
    |
    */

    'secure' => env('SESSION_SECURE_COOKIE'),

    /*
    |--------------------------------------------------------------------------
    | HTTP Access Only
    |--------------------------------------------------------------------------
    |
    | Setting this value to true will prevent JavaScript from accessing the
    | value of the cookie and the cookie will only be accessible through
    | the HTTP protocol. You are free to modify this option if needed.
    |
    */

    'http_only' => true,

    /*
    |--------------------------------------------------------------------------
    | Same-Site Cookies
    |--------------------------------------------------------------------------
    |
    | This option determines how your cookies behave when cross-site requests
    | take place, and can be used to mitigate CSRF attacks. By default, we
    | will set this value to "lax" since this is a secure default value.
    |
    | Supported: "lax", "strict", "none", null
    |
    */

    'same_site' => 'lax',

    /*
    |--------------------------------------------------------------------------
    | Partitioned Cookies
    |--------------------------------------------------------------------------
    |
    | Setting this value to true will tie the cookie to the top-level site for
    | a cross-site context. Partitioned cookies are accepted by the browser
    | when flagged "secure" and the Same-Site attribute is set to "none".
    |
    */

    'partitioned' => false,

];

```


---

**File:** `./config/structure-discoverer.php`

```php
<?php

return [
    /*
     *  A list of files that should be ignored during the discovering process.
     */
    'ignored_files' => [

    ],

    /**
     * The directories where the package should search for structure scouts
     */
    'structure_scout_directories' => [
        app_path(),
    ],

    /*
     *  Configure the cache driver for discoverers
     */
    'cache' => [
        'driver' => \Spatie\StructureDiscoverer\Cache\LaravelDiscoverCacheDriver::class,
        'store' => null,
    ],
];

```


---

**File:** `./config/tinker.php`

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Console Commands
    |--------------------------------------------------------------------------
    |
    | This option allows you to add additional Artisan commands that should
    | be available within the Tinker environment. Once the command is in
    | this array you may execute the command in Tinker using its name.
    |
    */

    'commands' => [
        // App\Console\Commands\ExampleCommand::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Auto Aliased Classes
    |--------------------------------------------------------------------------
    |
    | Tinker will not automatically alias classes in your vendor namespaces
    | but you may explicitly allow a subset of classes to get aliased by
    | adding the names of each of those classes to the following list.
    |
    */

    'alias' => [
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Classes That Should Not Be Aliased
    |--------------------------------------------------------------------------
    |
    | Typically, Tinker automatically aliases classes as you require them in
    | Tinker. However, you may wish to never alias certain classes, which
    | you may accomplish by listing the classes in the following array.
    |
    */

    'dont_alias' => [
        'App\Nova',
    ],

];

```


---

**File:** `./config/view.php`

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'paths' => [
        resource_path('views'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */

    'compiled' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ),

];

```

### Root Configuration


---

**File:** `./composer.json`

```json
{
    "name": "lunarphp/livewire-starter-kit",
    "type": "project",
    "description": "Livewire starter kit for Lunar e-commerce.",
    "keywords": [
        "lunar",
        "ecommerce",
        "e-commerce",
        "livewire",
        "laravel"
    ],
    "license": "MIT",
    "require": {
        "php": "^8.2",
        "guzzlehttp/guzzle": "^7.2",
        "http-interop/http-factory-guzzle": "^1.2",
        "laravel/framework": "^10.43|^11.0",
        "laravel/sanctum": "^3.3|^4.0",
        "laravel/tinker": "^2.8",
        "league/flysystem-aws-s3-v3": "^3.0",
        "lunarphp/lunar": "^1.0@beta",
        "lunarphp/stripe": "^1.0@beta",
        "lunarphp/table-rate-shipping": "^1.0@beta",
        "meilisearch/meilisearch-php": "^1.6",
        "predis/predis": "^2.2"
    },
    "require-dev": {
        "fakerphp/faker": "^1.23",
        "laravel/boost": "^2.1",
        "mockery/mockery": "^1.4.4",
        "nunomaduro/collision": "^7.0|^8.1",
        "pestphp/pest": "^4.3",
        "pestphp/pest-plugin-laravel": "^4.0",
        "spatie/laravel-ignition": "^2.0"
    },
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "Tests\\": "tests/"
        }
    },
    "scripts": {
        "post-autoload-dump": [
            "Illuminate\\Foundation\\ComposerScripts::postAutoloadDump",
            "@php artisan package:discover --ansi"
        ],
        "post-update-cmd": [
            "@php artisan vendor:publish --tag=laravel-assets --ansi --force",
            "@php artisan boost:update --ansi"
        ],
        "post-root-package-install": [
            "@php -r \"file_exists('.env') || copy('.env.example', '.env');\""
        ],
        "post-create-project-cmd": [
            "@php artisan key:generate --ansi"
        ]
    },
    "extra": {
        "laravel": {
            "dont-discover": []
        }
    },
    "config": {
        "optimize-autoloader": true,
        "preferred-install": "dist",
        "sort-packages": true,
        "allow-plugins": {
            "pestphp/pest-plugin": true,
            "php-http/discovery": true
        }
    },
    "minimum-stability": "dev",
    "prefer-stable": true
}
```


---

**File:** `./phpunit.xml`

```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="https://schema.phpunit.de/10.5/phpunit.xsd" bootstrap="vendor/autoload.php" colors="true" cacheDirectory=".phpunit.cache">
  <testsuites>
    <testsuite name="Unit">
      <directory suffix="Test.php">./tests/Unit</directory>
    </testsuite>
    <testsuite name="Feature">
      <directory suffix="Test.php">./tests/Feature</directory>
    </testsuite>
  </testsuites>
  <php>
    <env name="APP_ENV" value="testing"/>
    <env name="BCRYPT_ROUNDS" value="4"/>
    <env name="CACHE_DRIVER" value="array"/>
    <env name="DB_CONNECTION" value="sqlite"/>
    <env name="DB_DATABASE" value=":memory:"/>
    <env name="MAIL_MAILER" value="array"/>
    <env name="PULSE_ENABLED" value="false"/>
    <env name="QUEUE_CONNECTION" value="sync"/>
    <env name="SESSION_DRIVER" value="array"/>
    <env name="SCOUT_DRIVER" value="null"/>
    <env name="TELESCOPE_ENABLED" value="false"/>
  </php>
  <source>
    <include>
      <directory suffix=".php">./app</directory>
    </include>
  </source>
</phpunit>

```


---

**File:** `./artisan`

```text
#!/usr/bin/env php
<?php

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any of our classes manually. It's great to relax.
|
*/

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Artisan Application
|--------------------------------------------------------------------------
|
| When we run the console application, the current CLI command will be
| executed in this console and the response sent back to a terminal
| or another output device for the developers. Here goes nothing!
|
*/

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$status = $kernel->handle(
    $input = new Symfony\Component\Console\Input\ArgvInput,
    new Symfony\Component\Console\Output\ConsoleOutput
);

/*
|--------------------------------------------------------------------------
| Shutdown The Application
|--------------------------------------------------------------------------
|
| Once Artisan has finished running, we will fire off the shutdown events
| so that any final work may be done by the application before we shut
| down the process. This is the last thing to happen to the request.
|
*/

$kernel->terminate($input, $status);

exit($status);

```


---

**File:** `./.env.example`

```text
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:8lecoiFm33l9LVRWGDeF7+yuiuy3ZtZGwo2JuND92/I=
APP_DEBUG=true
APP_URL=

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=demostore
DB_USERNAME=root
DB_PASSWORD=18012000

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

STRIPE_KEY=
STRIPE_SECRET=

```

