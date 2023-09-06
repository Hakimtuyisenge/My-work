from django.db import models

from django.contrib.auth.models import AbstractBaseUser, BaseUserManager, \
    PermissionsMixin


Gender = (
    ('MALE', 'Male'),
    ('FEMALE', 'Female'),
    ('PREFER_NOT_SAY', 'Prefer Not to Say'),
)

class UserManager(BaseUserManager):
    def create_superuser(self, first_name, last_name, password, **other_fields):
        """Create and save a new superuser"""
        other_fields.setdefault('is_staff', True)
        other_fields.setdefault('is_superuser', True)
        other_fields.setdefault('is_active', True)

        if other_fields.get('is_staff') is not True:
            raise ValueError(
                'Superuser must be assigned to is_staff=True')
        if other_fields.get('is_superuser') is not True:
            raise ValueError(
                'Superuser must be assigned to is_superuser=True')

        return self.create_user( first_name, last_name, password, **other_fields)

    def create_user(self,  first_name, last_name, password=None, **other_fields):
        """Creates and saves a new User"""
    
        user = self.model(first_name=first_name,
                          last_name=last_name, **other_fields)
        user.set_password(password)
        user.save(using=self._db)
        return user


class CustomUser(AbstractBaseUser, PermissionsMixin):
    """Custom user model that support using email instead of username"""
    email = models.EmailField(max_length=255, unique=True, null=True)
    first_name = models.CharField(max_length=100, blank=False, null=False)
    last_name = models.CharField(max_length=100, blank=False, null=False)
    gender =  models.CharField( max_length=100,choices=Gender,blank=False, null=False)
    telephone = models.CharField(max_length=20, blank=False, null=False, unique=True)
    is_client = models.BooleanField(default=False)
    is_author = models.BooleanField(default=False)
    is_active = models.BooleanField(default=True)
    is_staff = models.BooleanField(default=False)

    objects = UserManager()
    USERNAME_FIELD = 'telephone'
    REQUIRED_FIELDS = ['first_name', 'last_name']

    class Meta:
        verbose_name = "User"

    def full_name(self):
        return self.first_name + " " + self.last_name

    def __str__(self):
        return self.full_name()

