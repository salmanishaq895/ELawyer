<?php
$pagination = "";
if($lastpage> 1)
{	
	$pagination .= '<div class="page_numbering_bar"><div class="page_numbering_inner_bar"> <span>';
	//previous button
	//if ($page_num> 1) 
		//$pagination.= '<span class="selected"><a href="'.$targetpage.$prev.'">Previous</a></span>';
	//pages	
	if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
	{	
		for ($counter = 1; $counter <= $lastpage; $counter++)
		{
			if($counter>1)
				$pagination.= " - ";
			if ($counter == $page_num)
				$pagination.= '<a class="selected"> ' . $counter . ' </a>';
			else
				$pagination.= '<a href="'.$targetpage.$counter.'">'.$counter.'</a>';
		}
	}
	elseif($lastpage> 5 + ($adjacents * 2))	//enough pages to hide some
	{
		//close to beginning; only hide later pages
		if($page_num < 1 + ($adjacents * 2))		
		{
			for ($counter = 1; $counter < 2 + ($adjacents * 2); $counter++)
			{
				if($counter>1)
					$pagination.= " - ";
				if ($counter == $page_num)
					$pagination.= '<a class="selected"> ' . $counter . ' </a>';
				else
					$pagination.= '<a href="'.$targetpage.$counter.'">'.$counter.'</a>';
			}
			$pagination.= " ... ";
			$pagination.= '<a href="'.$targetpage.$lpm1.'">'.$lpm1.'</a>';
			$pagination.= ' - <a href="'.$targetpage.$lastpage.'">'.$lastpage.'</a>';
		}
		//in middle; hide some front and some back
		elseif($lastpage - ($adjacents * 2)> $page_num && $page_num> ($adjacents * 2))
		{
			$pagination.= '<a href="'.$targetpage.'1">1</a>';
			$pagination.= ' - <a href="'.$targetpage.'2">2</a>';
			$pagination.= " ... ";
			for ($counter = $page_num - $adjacents; $counter <= $page_num + $adjacents; $counter++)
			{
				if($counter>($page_num - $adjacents))
					$pagination.= " - ";
				if ($counter == $page_num)
					$pagination.= '<a class="selected"> ' . $counter . ' </a>';
					 
				else
					$pagination.= '<a href="'.$targetpage.$counter.'">'.$counter.'</a>';
			}
			$pagination.= " ... ";
			$pagination.= '<a href="'.$targetpage.$lpm1.'">'.$lpm1.'</a>';
			$pagination.= ' - <a href="'.$targetpage.$lastpage.'">'.$lastpage.'</a>';		
		}
		//close to end; only hide early pages
		else
		{
			$pagination.= '<a href="'.$targetpage1.'"> 1 </a>';
			$pagination.= ' - <a href="'.$targetpage2.'"> 2 </a>';
			$pagination.= " ... ";
			for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
			{
				if($counter > ($lastpage - (2 + ($adjacents * 2))))
					$pagination.= " - ";
				if ($counter == $page_num)
					$pagination.= '<a class="selected"> ' . $counter . ' </a>';
				else
					$pagination.= '<a href="'.$targetpage.$counter.'">'.$counter.'</a>';
			}
		}
	}
	
	//next button
	//if ($page_num < $counter - 1) 
		//$pagination.= '<span class="selected"><a href="'.$targetpage.$next.'">Next</span></a>';
//	else
	//	$pagination.= '<span class="selected">Next</span>';
	$pagination.= "</div></div>";		
}

echo $pagination;
?>