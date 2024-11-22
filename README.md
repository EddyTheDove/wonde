### Task 1 - Api
1) Clone repo
2) Docker up 

```
docker compose up 
```

Check code at: 
```
app/Http/Controllers/AppController.php
app/Services/WondeApi.php
```

3) Access home page http://localhost


### Task 2 - Database
```
INSERT INTO `role_user` (user_id, role_id)
VALUES (
    SELECT `id` FROM users WHERE `first_name` = "Felipa" AND `last_name` = "Hamill",
    SELECT `id` FROM roles WHERE `name` = "admin"
)

INSERT INTO `company_user` (company_id, user_id)
VALUES (
    SELECT `id` FROM companies WHERE `name` = "Koss-Brown Ltd”,
    SELECT `id` FROM users WHERE `first_name` = "Felipa" AND `last_name` = "Hamill"
)
```

### Task 3 - code
Modify the third route from get to post
```
Route::post('users', [UsersController::class, 'store']);
```

Uncomment code in the view file resources/views/uses/index.blade.php
```
@if (count($users))
    @foreach ($users as $user)
        <li>{{ $user->name }} - {{$user->email}}</li>
    @endforeach
@else 
    <li>None</li>
@endif
```