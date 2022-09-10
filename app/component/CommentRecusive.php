<?php
namespace App\Components;

use App\Models\Comment;


class CommentRecusive{
	private $html;
	public function __construct(){
		$this->html='';
	}
	public function commentRecusiveAdd($parentId=0,$subMark=''){
		$data=Comment::where('parent_id',$parentId)->get();
		foreach($data as $dataItem){
			$this->html .=  '<input value="'. $dataItem->id .'">'.$subMark . $dataItem->name. '</input>';
			$this->commentRecusiveAdd($dataItem->id, $subMark . '--');
		}
		return $this->html;
	}
	// public function commentRecusiveEdit($parentIdCommentEdit, $parentId=0,$subMark=''){
	// 	$data=CommentModel::where('parent_id',$parentId)->get();
	// 	foreach($data as $dataItem){
	// 		if($parentIdCommentEdit==$dataItem->id){
	// 			$this->html.= '<option selected value="'. $dataItem->id .'">'.$subMark . $dataItem->name. '</option>';
	// 		}else{
	// 			$this->html.= '<option value="'. $dataItem->id .'">'.$subMark . $dataItem->name. '</option>';
	// 		}
			
	// 		$this->commentRecusiveEdit($parentIdCommentEdit, $dataItem->id,$subMark . '--');
	// 	}
	// 	return $this->html;
	// }
}
?>