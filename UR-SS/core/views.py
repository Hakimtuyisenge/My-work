from django.contrib.auth import authenticate, login, logout
from django.shortcuts import render, redirect
from django.contrib import messages 
from account.models import CustomUser
from django.contrib.auth.mixins import LoginRequiredMixin
from django.views.generic import TemplateView, CreateView, ListView, UpdateView, DetailView
from django.views.generic.edit import DeleteView
from django.utils.text import slugify
from .form import NewPostForm, FeedBackForm
from .models import Post, Category,Testimonial
from account.forms import UpdateUserProfile
from django.db.models import Q
import datetime


# client side views
class LandingPageView(ListView):
    template_name = 'client/index.html'
    model = Category
  
    def get_context_data(self, *args, **kwargs):
        context = super().get_context_data(*args, **kwargs)
        category_num= Category.objects.all().count()
        # post_list = Post.objects.filter(category='id')
        category_list = Category.objects.all()
        post_num =  Post.objects.filter(status='Unpaid').count()
        post_list_num = Post.objects.all().count()

        # print(post_list_num)
         # display
        context['post_list_num'] = post_list_num
        testimonial_list = Testimonial.objects.all()
        context['testimonial_list'] = testimonial_list
        context['post_num'] = post_num
        context['category_num'] = category_num
        context['category_list'] = category_list
        return context


def clientRegister(request):
    if request.method == 'POST':
        first_name = request.POST.get('firstName')
        last_name = request.POST.get('lastName')
        telephone = request.POST.get('telephone')
        gender = request.POST.get('gender')
        password = request.POST.get('password')
        confirm_password = request.POST.get('confirmPassword')

        if password != confirm_password:
            # Passwords don't match
                return render(request, 'client/register.html', {'error': "Passwords don't match"})
        else:
            # Save user registration information
            user = CustomUser.objects.create_user(
                first_name=first_name,
                last_name=last_name,
                telephone=telephone,
                gender=gender,
                is_client=True,
                password=password,
            )
            return redirect('client-login')
    return render(request, 'client/register.html')


def clientLogin(request):
    if request.method == 'POST':
        telephone = request.POST.get('telephone')
        password = request.POST.get('password')
        user = authenticate(request, telephone=telephone, password=password)
        if user is not None:
            login(request, user)
            # Redirect to a success page.
            return redirect('landing')
        else:
            # Return an 'invalid login' error message.
            return render(request, 'client/login.html', {'error': 'Invalid login'})
    else:
        return render(request, 'client/login.html')



# payment function
def confirm_payment(request, pk):
    post = Post.objects.get(id=pk)
    post.status = 'Paid'
    post.save()
    messages.success(request, "payment made successfully")
    return redirect("client-posts")

def confirm_payment_category(request, pk):
    category = Category.objects.get(id=pk)
    category.save()
    messages.success(request, "payment made successfully")
    return redirect("client-posts")

def post(request):
    blog = None

    if request.user.is_authenticated:
        post = Post.objects.get_or_create(author=request.user, status = 'Unpaid')
        context = {"post":post}
        return render (request, 'client/post-list.html', context)

class CategoriesView(ListView):
     template_name = 'client/category.html'
     model = Category
  
     def get_context_data(self, *args, **kwargs):
        context = super().get_context_data(*args, **kwargs)
        # post_num= Post.objects.filter(category=pk).count()
        # post_list = Post.objects.filter(category='id')
        category_list = Category.objects.all()

        # context['post_num'] = post_num
        context['category_list'] = category_list
        return context
   
class ClientPostView(LoginRequiredMixin, ListView):
    template_name = 'client/post-list.html'
    login_url = 'client-login'
    model = Post
  
    def get_context_data(self, *args, **kwargs):
        context = super().get_context_data(*args, **kwargs)
        post_num= Post.objects.all().count()
        all_post = Post.objects.all()
        context['post_num'] = post_num
        context['all_post'] = all_post
        return context

def CategoryPostView(request, cats):
    category_post_list = Post.objects.filter(category=cats)
    category_post_num = Post.objects.filter(category=cats).count()
    return render (request, 'client/category-posts.html' , 
    {'category_post_list':category_post_list, 'cats':cats, ' category_post_num': category_post_num})
    
class PostDetailView(DetailView):
    model = Post
    template_name = 'client/client-post-detail.html'

class FeedbackView(CreateView):
    template_name = 'client/feedback.html' 
    form_class = FeedBackForm
    success_url = ('/')
    def form_valid(self, form):
        return super().form_valid(form)
    
class TermsView(TemplateView):
    template_name = 'admin/terms.html'  
    
  
# end of client side


# admin side views
class HomePageView(LoginRequiredMixin, ListView):
    template_name = 'admin/home.html'
    model = Post
  
    def get_context_data(self, *args, **kwargs):
        today = datetime.date.today() 
        context = super().get_context_data(*args, **kwargs)
        post_num= Post.objects.filter(author=self.request.user).count()
        post_num_recent= Post.objects.filter(author=self.request.user, updated__gt=today).count()
        all_post = Post.objects.filter(author=self.request.user)
        all_post_sold_num = Post.objects.filter(author=self.request.user, status='Paid').count()
        all_post_waiting_num = Post.objects.filter(author=self.request.user, status='Unpaid').count()
        all_post_sold_num_recent = Post.objects.filter(author=self.request.user, status='Paid', updated__gt=today).count()
        all_post_waiting_num_recent = Post.objects.filter(author=self.request.user, status='Unpaid', updated__gt=today).count()
        user = CustomUser.objects.all()


        context['all_post_sold_num_recent'] = all_post_sold_num_recent
        context['all_post_waiting_num_recent'] = all_post_waiting_num_recent       
        context['all_post_sold_num'] = all_post_sold_num
        context['all_post_waiting_num'] = all_post_waiting_num
        context['post_num_recent'] = post_num_recent
        context['post_num'] = post_num
        context['all_post'] = all_post
        context['user'] = user
        return context

class NewPostView(LoginRequiredMixin, CreateView):
    form_class = NewPostForm
    success_url = ('post-list')
    template_name = 'admin/new-post.html'

    def form_valid(self, form):
            form.instance.author = self.request.user
            form.instance.slug = slugify(form.instance.title)
            form.fields['content'].widget = SummernoteInplaceWidget()
            return super().form_valid(form)

class PostListView(LoginRequiredMixin, ListView):
    template_name = 'admin/post-list.html'
    model = Post
  
    def get_context_data(self, *args, **kwargs):
        context = super().get_context_data(*args, **kwargs)
        post_num= Post.objects.all().count()
        all_post = Post.objects.filter(author=self.request.user)

        context['post_num'] = post_num
        context['all_post'] = all_post
        return context

class PaidPostListView(LoginRequiredMixin, ListView):
    template_name = 'admin/paid-post.html'
    model = Post
    context_object_name = 'paid_post'

    def get_queryset(self):
        queryset = Post.objects.filter(status='Paid', author=self.request.user)
        return queryset

class UnpaidPostListView(LoginRequiredMixin, ListView):
    template_name = 'admin/unpaid-post.html'
    model = Post
    context_object_name = 'unpaid_post'
    

    def get_queryset(self):
        queryset = Post.objects.filter(status='Unpaid', author=self.request.user)
        return queryset


class ProfileView(LoginRequiredMixin, UpdateView):
     template_name = 'admin/profile.html'
     form_class = UpdateUserProfile
     success_url = ('home')

     def get_object(self):
        return self.request.user

def logoutuser(request):
    logout(request)
    return redirect('/')
    