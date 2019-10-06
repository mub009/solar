<div class="empty_wrapper">
<h3 class="page-title-empty" id="repo-command-line-instructions">
Command line instructions
</h3>
<div class="git-empty js-git-empty">
<fieldset>
<h5>Git global setup</h5>
<pre class="bg-light">git config --global user.name "mubashir"
git config --global user.email "mubashir.in@gmail.com"
</pre>
</fieldset>
<fieldset>
<h5>Create a new repository</h5>
<pre class="bg-light">git clone <span class="js-clone">https://gitlab.com/mub009/programming.git</span>
cd programming
touch README.md
git add README.md
git commit -m "add README"
<span>git push -u origin master</span></pre>
</fieldset>
<fieldset>
<h5>Existing folder</h5>
<pre class="bg-light">cd existing_folder
git init
git remote add origin <span class="js-clone">https://gitlab.com/mub009/programming.git</span>
git add .
git commit -m "Initial commit"
<span>git push -u origin master</span></pre>
</fieldset>
<fieldset>
<h5>Existing Git repository</h5>
<pre class="bg-light">cd existing_repo
git remote rename origin old-origin
git remote add origin <span class="js-clone">https://gitlab.com/mub009/programming.git</span>
<span>git push -u origin --all
git push -u origin --tags</span></pre>
<div class="prepend-top-20">
<a data-confirm="You are going to remove mubashir / programming. Removed project CANNOT be restored! Are you ABSOLUTELY sure?" class="btn btn-inverted btn-remove float-right" rel="nofollow" data-method="delete" href="/mub009/programming">Remove project</a>
</div>
</fieldset>
</div>
</div>