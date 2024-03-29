<!DOCTYPE html>
<html>

<head>
  <title>Bootstrap Multiselect</title>
  <meta name="robots" content="noindex, nofollow" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

  <link rel="stylesheet" href="docs/css/bootstrap-4.5.2.min.css" type="text/css">
  <link rel="stylesheet" href="docs/css/prettify.min.css" type="text/css">
  <link rel="stylesheet" href="dist/css/bootstrap-multiselect.css" type="text/css">
  <link rel="stylesheet" href="docs/css/bootstrap-example.min.css" type="text/css">

  <script data-main="dist/js/" src="docs/js/prettify.min.js"></script>
  <script data-main="dist/js/" src="docs/js/jquery-2.2.4.min.js"></script>
  <script type="text/javascript" src="docs/js/bootstrap.bundle-4.5.2.min.js"></script>
  <script data-main="dist/js/" src="docs/js/require-2.3.5.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function () {
      window.prettyPrint() && prettyPrint();
    });
  </script>

  <style>
    .nav-link.active {
      font-weight: bold;
    }
  </style>
</head>

<body data-spy="scroll" data-target="#affix" style="font-size:14px;">
  <a href="https://github.com/davidstutz/bootstrap-multiselect">
    <img style="position: fixed; top: 0; right: 0; border: 0;"
      src="https://s3.amazonaws.com/github/ribbons/forkme_right_red_aa0000.png" alt="Fork me on GitHub">
  </a>

  <div class="container">
    <div class="row">
      <div class="col-md-3 pt-4" id="affix">
        <nav class="bg-light navbar navbar-light position-fixed">
          <div class="navbar-nav">
            <a class="nav-link" href="index.html#getting-started">Getting Started</a>
            <a class="nav-link" href="index.html#configuration-options">Configuration Options</a>
            <a class="nav-link" href="index.html#templates">Templates</a>
            <a class="nav-link" href="index.html#styling">Styling</a>
            <a class="nav-link" href="index.html#methods">Methods</a>
            <a class="nav-link" href="index.html#further-examples">Further Examples</a>
            <a class="nav-link" href="index.html#post">Server-Side Processing</a>
            <a class="nav-link" href="index.html#keyboard-support">Keyboard Support</a>
            <a class="nav-link active" href="#require-js">Require JS</a>
            <a class="nav-link" href="index.html#faq">Frequently Asked Questions</a>
            <a class="nav-link" href="index.html#known-issues">Known Issues</a>
            <a class="nav-link" href="tests/SpecRunner.html">Tests</a>
            <a class="nav-link" href="index.html#migration">Migrating to Bootstrap v4</a>
            <a class="nav-link" href="index.html#license">License</a>
          </div>
        </nav>
      </div>
      <div class="col-md-9 pt-4">
        <div class="pb-2 mb-2 border-bottom">
          <h1>Bootstrap Multiselect</h1>
          <h2 style="display:none;" id="require-js"></h2>
        </div>

        <p class="alert alert-info">
          Please consult the <a href="#faq">FAQ</a>, the <a
            href="https://github.com/davidstutz/bootstrap-multiselect/issues">Issue Tracker</a>
          or <a href="https://stackoverflow.com/questions/tagged/bootstrap-multiselect">Stack Overflow</a> before
          creating a new issue; when
          creating an issue or a pull request, read <a href="#how-to-contribute">how to contribute</a> first.
        </p>

        <div class="alert alert-secondary">
          <p><b>Consider making a donation to support the development of this plugin:</b></p>
          <div class="text-center">
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
              <input type="hidden" name="cmd" value="_s-xclick">
              <input type="hidden" name="hosted_button_id" value="V95Q7QK6JY32Q">
              <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0"
                name="submit" alt="PayPal - The safer, easier way to pay online!">
              <img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
            </form>
          </div>
          <a href="http://davidstutz.de/donate/" class="small float-right">Why Donate?</a>
          <div class="clearfix"></div>
        </div>

        <div class="page-header">
          <h2 id="require-js">Require JS</h2>
        </div>

        <p>Getting started with Bootstrap Multiselect and <a href="http://requirejs.org/" target="_blank">Require
            JS</a>:</p>

        <ol>
          <li>
            <h3>Link the CSS Files</h3>

            <pre class="prettyprint linenums">
&lt;link rel=&quot;stylesheet&quot; href=&quot;css/bootstrap.min.css&quot; type=&quot;text/css&quot;/&gt;
&lt;link rel=&quot;stylesheet&quot; href=&quot;css/bootstrap-multiselect.css&quot; type=&quot;text/css&quot;/&gt;
</pre>
          </li>
          <li>
            <h3>Include Require JS</h3>

            <pre class="prettyprint linenums">
&lt;script data-main=&quot;dist/js/&quot; src=&quot;js/require.min.js&quot;&gt;&lt;/script&gt;
</pre>
          </li>
          <li>
            <h3>Create a Select</h3>

            <p>
              Now simply use HTML to create your <code>select</code> input which you want to turn into a multiselect.
              Remember to set the <code>multiple</code> attribute as to get a real multiselect - but do not worry, the
              plugin can also be used as usual select without the <code>multiple</code> attribute being present.
            </p>

            <pre class="prettyprint linenums">
&lt;!-- Build your select: --&gt;
&lt;select id=&quot;example-getting-started&quot; multiple=&quot;multiple&quot;&gt;
&lt;option value=&quot;cheese&quot;&gt;Cheese&lt;/option&gt;
&lt;option value=&quot;tomatoes&quot;&gt;Tomatoes&lt;/option&gt;
&lt;option value=&quot;mozarella&quot;&gt;Mozzarella&lt;/option&gt;
&lt;option value=&quot;mushrooms&quot;&gt;Mushrooms&lt;/option&gt;
&lt;option value=&quot;pepperoni&quot;&gt;Pepperoni&lt;/option&gt;
&lt;option value=&quot;onions&quot;&gt;Onions&lt;/option&gt;
&lt;/select&gt;
</pre>
          </li>
          <li>
            <h3>Call the Plugin</h3>

            <p>
              In the end, simply call the plugin on your <code>select</code>:
            </p>

            <p class="alert alert-info">
              Note that in this example, jQuery is included manually due to the file structure of this documentation;
              however this is not necessary.
            </p>

            <div class="example">
              <script type="text/javascript">
                require(["bootstrap-multiselect"], function (purchase) {
                  $('#example-getting-started').multiselect();
                });
              </script>
              <select id="example-getting-started" multiple="multiple">
                <option value="cheese">Cheese</option>
                <option value="tomatoes">Tomatoes</option>
                <option value="Mozzarella">Mozzarella</option>
                <option value="Mushrooms">Mushrooms</option>
                <option value="Pepperoni">Pepperoni</option>
                <option value="Onions">Onions</option>
              </select>
            </div>
            <div class="highlight">
              <pre class="prettyprint linenums">
&lt;!-- Initialize the plugin: --&gt;
&lt;script type=&quot;text/javascript&quot;&gt;
require(['bootstrap-multiselect'], function(purchase){
$('#example-getting-started').multiselect();
});
&lt;/script&gt;
</pre>
            </div>
          </li>
        </ol>

        <hr>
        <p>
          &copy; 2012 - 2022
          <a href="http://davidstutz.de">David Stutz</a>, <a href="https://davidstutz.de/impressum/">Impressum</a>, <a
            href="https://davidstutz.de/datenschutz/">Datenschutz</a> - dual licensed: <a
            href="http://www.apache.org/licenses/LICENSE-2.0">Apache License v2.0</a>, <a
            href="http://opensource.org/licenses/BSD-3-Clause">BSD 3-Clause License</a>
        </p>
      </div>
    </div>
  </div>
</body>

</html>