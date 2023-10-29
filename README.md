### Database table seeder command for Faker
```
 php artisan db:seed --class=ArticlesTableSeeder
```

### Changing table fields in laravel
1. allow fields to insert in database 
2. Change in specific Model `app\Models`

```
    class student extends Model
    {
        use HasFactory;

        protected $fillable = ["name","email","address"];
    }
```