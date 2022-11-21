<?php 

// DTO = Data to Object!, standard on C#
// used also in PHP

class Product 
{
    public string $id;
    public string $name;
    public int $price;
    
    /**
     * Like in JAVA AND C#, there are constructor
     * It use class name 
     * eg. public Product(string id, string name, int price)
     * @param mixed $id 
     * @param mixed $name 
     * @param mixed $price 
     * @return void 
     */
    public function __construct($id, $name, $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }
}

class CartItem 
{
    private Product $product;
    private int $jumlah;

    public function __construct(Product $p, int $j)
    {
        $this->product = $p;
        $this->jumlah = $j;
    }

    public function GetSubtotal() 
    {
        return $this->product->price * $this->jumlah;
    }

    public function AppendJumlah(int $j)
    {
        $this->jumlah += $j;
    }

    public function GetProduct() 
    {
        return $this->product;
    }

    public function GetJumlah()
    {
        return $this->jumlah;
    }

    public function SetJumlah($j)
    {   
        $this->jumlah = $j;
    }

    public function Render()
    {
        // This is heredoc, @see https://www.php.net/manual/en/language.types.string.php#example-36
        // `` -> ini seperti di JS untuk heredoc
        return <<<TEXT
        <div class="item">
            <h4>{$this->product->name}</h4>
            <h6>Harga : Rp. <span class="harga">{$this->product->price}</span></h6>
            <input type="number" name="jumlah" value="{$this->jumlah}"> <br/>
            <button onclick="updateCartItem(event,'{$this->product->id}')">Update</button>
            <button onclick="removeFromCart('{$this->product->id}')">Trash</button>
        </div>
        TEXT;
    }
}

class Cart
{
    /**
     * Cart Item Array
     * @var CartItem[]
     */
    private $cartItem = [];
    private static $singleton;

    public static function singleton()
    {
        if (static::$singleton == null)
            static::$singleton = new Cart();
        return static::$singleton;
    }

    public function AddItem(CartItem $i)
    {
        $index = -1;
        foreach ($this->cartItem as $key => $value) {
            if ($value->GetProduct()->id == $i->GetProduct()->id)
            {
                $index = $key;
            }
        }

        if($index > -1)
        {
            $this->cartItem[$index]->AppendJumlah($i->GetJumlah());
            return;
        }

        $this->cartItem[] = $i;
    }

    public function UpdateItem(CartItem $i)
    {
        $index = -1;
        foreach ($this->cartItem as $key => $value) {
            if ($value->GetProduct()->id == $i->GetProduct()->id)
            {
                $index = $key;
            }
        }

        if($index > -1)
        {
            $this->cartItem[$index]->SetJumlah($i->GetJumlah());
            return true;
        }
        else 
        {
            return false;
        }
    }

    public function DeleteItem(CartItem $i)
    {
        $index = -1;
        foreach ($this->cartItem as $key => $value) {
            if ($value->GetProduct()->id == $i->GetProduct()->id)
            {
                $index = $key;
            }
        }

        if($index > -1)
        {
            unset($this->cartItem[$index]); // Remove from Index
            return true;
        }
        else 
        {
            return false;
        }
    }

    public function GetAllItem()
    {
        return $this->cartItem;
    }
}