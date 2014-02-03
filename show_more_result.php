<--- --------------------------------------------------------------------------------------- ----
	
	Blog Entry:
	Creating An Infinite Scroll Effect With jQuery And ColdFusion
	
	Author:
	Ben Nadel / Kinky Solutions
	
	Link:
	http://www.bennadel.com/index.cfm?event=blog.view&id=1801
	
	Date Posted:
	Jan 4, 2010 at 8:57 AM
	
---- --------------------------------------------------------------------------------------- --->


<!DOCTYPE HTML>
<html>
<head>
	<title>Infinite Scroll With jQuery And AJAX</title>
	<style type="text/css">
 
		#list {
			list-style-type: none ;
			margin: 0px 0px 0px 0px ;
			padding: 0px 0px 0px 0px ;
			}
 
		#list li {
			border: 2px solid #D0D0D0 ;
			cursor: pointer ;
			float: left ;
			height: 50px ;
			line-height: 49px ;
			margin: 0px 10px 10px 0px ;
			text-align: center ;
			white-space: no-wrap ;
			width: 150px ;
			}
 
		#list li.on {
			background-color: #F0F0F0 ;
			border-color: #FFCC00 ;
			font-weight: bold ;
			}
 
		#loader {
			clear: both ;
			}
 
	</style>
	<script type="text/javascript" src="../jquery-1.4a2.js"></script>
	<script type="text/javascript">
 
		// I get more list items and append them to the list.
		function getMoreListItems( list, onComplete ){
			// Get the next offset from the list data. If the next
			// offset doesn't exist, default to one (1).
			var nextOffset = (list.data( "nextOffset" ) || 1);
 
			// Check to see if there is any existing AJAX call
			// from the list data. If there is, we want to return
			// out of this method - no reason to overload the
			// server with extraneous requests.
			if (list.data( "xhr" )){
 
				// Let the active AJAX request complete.
				return;
 
			}
 
			// Get a reference to the loader.
			var loader = $( "#loader" );
 
			// Update the text of the loader to denote AJAX
			// activity as the list items are retreived.
			loader.text( "Loading New Items" );
 
			// Launch AJAX request for next set of results and
			// store the resultant XHR request with the list.
			list.data(
				"xhr",
				$.ajax({
					type: "get",
					url: "./infinite_scroll.cfm",
					data: {
						offset: nextOffset,
						count: 60
					},
					dataType: "json",
					success: function( response ){
						// Append the response.
						appendListItems( list, response );
 
						// Update the next offset.
						list.data(
							"nextOffset",
							(nextOffset + 60 + 1)
						);
					},
					complete: function(){
						// Update the loader text to denote no
						// AJAX activity.
						loader.text( "Page Loaded" );
 
						// Remove the stored AJAX request. This
						// will allow subsequent AJAX requests
						// to execute.
						list.removeData( "xhr" );
 
						// Call the onComplete callback.
						onComplete();
					}
				})
			);
		}
 
 
		// I append the given list items to the given list.
		function appendListItems( list, items ){
			// Create an array to hold our HTML buffer - this will
			// be faster than creating individual DOM elements and
			// appending them piece-wise.
			var htmlBuffer = [];
 
			// Loop over the array to create each LI element.
			$.each(
				items,
				function( index, value ){
 
					// Append the LI markup to the buffer.
					htmlBuffer.push( "<li>" + value + "</li>" );
 
				}
			);
 
			// Append the html buffer to the list.
			list.append( htmlBuffer.join( "" ) );
		}
 
 
		// I check to see if more list items are needed based on
		// the scroll offset of the window and the position of
		// the container.
		function isMoreListItemsNeeded( container, list ){
			// Get the view frame for the window - this is the
			// top and bottom coordinates of the visible slice of
			// the document.
			var viewTop = $( window ).scrollTop();
			var viewBottom = (viewTop + $( window ).height());
 
			// Get the offset of the bottom of the list container.
			//
			// NOTE: I am using the container rather than the list
			// itself since the list has FLOATING elements, which
			// might cause the UL to report an inacturate height.
			var containerBottom = Math.floor(
				container.offset().top +
				container.height()
			);
 
			// I am the scroll buffer; this is the amount of
			// pre-bottom space we want to take into account
			// before we start loading the next items.
			var scrollBuffer = 150;
 
			// Check to see if the container bottom is close
			// enought (with buffer) to the scroll of the
			// window to trigger the loading of new items.
			if ((containerBottom - scrollBuffer) <= viewBottom){
 
				// The bottom of the container is close enough
				// to the bottom of thew view frame window to
				// imply more item loading.
				return( true );
 
			} else {
 
				// The container bottom is too far below the view
				// frame bottom - no new items needed yet.
				return( false );
 
			}
		}
 
 
		// I check to see if more list items are needed, and, if
		// they are, I load them.
		function checkListItemContents( container, list ){
			// Check to see if more items need to be loaded.
			if (isMoreListItemsNeeded( container, list )){
 
				// Load new items.
				getMoreListItems(
					list,
					function(){
						// Once the list items have been loaded
						// re-trigger this method to make sure
						// that enough were loaded. This will make
						// sure that there are always enough
						// default items loaded to allow the
						// window to scroll.
						checkListItemContents( container, list );
					}
				);
 
			}
		}
 
 
		// -------------------------------------------------- //
		// -------------------------------------------------- //
 
 
		// When the DOM is ready, initialize document.
		jQuery(function( $ ){
 
			// Get a reference to the list container.
			var container = $( "#container" );
 
			// Get a reference to the list.
			var list = $( "#list" );
 
			// Bind a click handler to the list so we can toggle
			// the ON class of the list items upon click. This is
			// simply to demonstrate "live" binding to the list
			// elements as they are loaded.
			list.click(
				function( event ){
					var target = $( event.target );
 
					// Check to make sure the list item is the
					// event target.
					if (target.is( "li" )){
 
						// Toggle the ON class.
						target.toggleClass( "on" );
 
					}
				}
			);
 
			// Bind the scroll and resize events to the window.
			// Whenever the user scrolls or resizes the window,
			// we will need to check to see if more list items
			// need to be loaded.
			$( window ).bind(
				"scroll resize",
				function( event ){
					// Hand the control flow off to the method that
					// worries about the list content.
					checkListItemContents( container, list );
				}
			);
 
			// Now that the page is loaded, trigger the "Get"
			// method to populate the list with data.
			checkListItemContents( container, list );
 
		});
 
	</script>
</head>
<body>
 
	<h1>
		Infinite Scroll With jQuery And AJAX
	</h1>
 
	<div id="container">
 
		<ul id="list">
			<!--- Content loaded dynamically. --->
		</ul>
 
		<!---
			NOTE: While this element does have some "feedback"
			purposes, I am mostly using it to make sure the
			"CONTINER" element reports back a valid height -
			it will cause proper rendering.
		--->
		<div id="loader">
			Page Loaded.
		</div>
 
	</div>
 
</body>
</html>