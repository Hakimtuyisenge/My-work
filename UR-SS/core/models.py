from django.db import models
from account.models import CustomUser
from django.urls import reverse

payments = (
    ('Paid','Paid'),
    ('Unpaid','Unpaid')
)

# post category
class Category(models.Model):
    name = models.CharField(max_length=255, default="za") 
    def __str__(self):
        return self.name


# posts
class Post(models.Model):
    author = models.ForeignKey(CustomUser, on_delete=models.CASCADE)
    title = models.CharField(max_length = 225)
    intro =models.CharField(max_length=225, null=True)
    body = models.TextField()
    category = models.CharField(max_length=225, default="Music") 
    slug = models.SlugField(null=True)
    price= models.DecimalField(max_digits=10, decimal_places=2)
    image = models.ImageField(upload_to = "images")
    status = models.CharField(max_length=100, choices=payments, blank=True, default='Unpaid')
    updated = models.DateTimeField(auto_now=True)
    created = models.DateTimeField(auto_now_add=True)
    
    
    class Meta:
            ordering = ['created'] 

    def __str__(self):
        return self.title + ' | ' + str(self.author)
    
    def get_absolute_url(self):
      return reverse('client-post-detail', kwargs={'slug': self.slug})

    def save(self, *args, **kwargs):
        self.slug = self.slug or slugify(self.title)
        super().save(*args, **kwargs)
    

class Testimonial(models.Model):
     First_name = models.CharField(max_length=250,null=True)
     Last_name = models.CharField(max_length=250,null=True)
     Email_name = models.CharField(max_length=250,null=True)
     Image = models.ImageField(upload_to = "images",null=True)
     Message = models.TextField()

     def __str__(self):
          return self.First_name + " " + self.Last_name + " " + self.Message
    
     def full_name(self):
        return self.First_name + " " + self.Last_name