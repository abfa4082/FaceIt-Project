<?php

class Post {
	public $ID;
	public $title;
	public $text;
	public $timestamp;
	public $comments;
	public $posterProfile;
	public $numComments;
}

class PostUser {
	public $posterID;
	public $firstName;
	public $lastName;
	public $profilePicURL;
}

class UserProfile{
	public $ID;
	public $username;
	public $firstName;
	public $lastName;
	public $email;
	public $description;
	public $profilePicURL;
}


function getDB(){//replace all other uses so that when site goes live I only have to change this function from root,root
  return new mysqli("localhost", "root", "", "faceit");
}

function loginCheck($mysqli, $username, $password){
	$query = "SELECT ID,Password FROM Users WHERE username = ?";

	$statement = $mysqli->prepare($query);
	$statement->bind_param("s", $username);
	$statement->execute();

	$result = $statement->get_result();
	$row = $result->fetch_array(MYSQLI_NUM);

	$row_count = mysqli_num_rows($result);


	if($row_count == 0){
		return false;
	}

	$statement->close();

	$passwordHash = $row[1];
	$ID = $row[0];

	if(password_verify($password, $passwordHash)){

		return $ID;

    }else{
    	return false;
    }
}

function createAccount($mysqli, $username, $password, $email){
	// // Check if username is a duplicate
	// $usernameCheck=mysql_query("SELECT * FROM users (username, password, email) WHERE username=$username");
	// if(mysqul_num_row($usernameCheck)>=1){
	// 	echo"That username is already being used.";
	// }

	// // Check if email is a duplicate
	// $emailCheck=mysql_query("SELECT * FROM users (username, password, email) WHERE email=$email");
	// else if(mysqul_num_row($emailCheck)>=1){
	// 	echo "That email is already being used for a different account.";
	// }

	// else{
	// 	$sql = "INSERT INTO users (username, password, email)
	// 	VALUES ($username, $password, $email)";
	// }

	// Check if username is a duplicate
	$usernameCheck = 'SELECT * FROM Users WHERE username = ?';

	$statement = $mysqli->prepare($usernameCheck);
	$statement->bind_param("s", $username);
	$statement->execute();
	$statement->fetch();

	$row_count = $statement->num_rows;
	$statement->close();


	if($row_count > 0){
		echo"That username is already being used.";
	}else{
		// Check if email is a duplicate
		$emailCheck= "SELECT * FROM users WHERE email = ?";
		$statement = $mysqli->prepare($emailCheck);
		$statement->bind_param("s", $email);
		$statement->execute();
		$statement->fetch();

		$row_count = $statement->num_rows;
		$statement->close();

		if($row_count > 0){
			echo "That email is already being used for a different account.";
		}else{
			$sql = "INSERT INTO users (Username, Password, Email) VALUES (?, ?, ?)";
			if($statement = $mysqli->prepare($sql)){
				$statement->bind_param("sss", $username, password_hash($password, PASSWORD_DEFAULT), $email);
				$statement->execute();

				if($statement){
					setcookie("userID",$statement->insert_id, false, '/');
					header( "Location: ../Pages/profilePage.php?id=".$statement->insert_id);
				}else{
					print("Error. Please contact Administrator <br>\r\n <br>\r\n");
				}
			}else{
				print("Error. Please contact Administrator <br>\r\n <br>\r\n");
			}
		}
	}

}

function editProfilePage($mysqli, $firstname, $lastname, $email,$description, $userID){



	$emailCheck= "UPDATE users SET FirstName = ?, LastName = ?, Description = ?, Email = ? WHERE ID = ?";
		if($statement = $mysqli->prepare($emailCheck)){
			$statement->bind_param("ssssi", $firstname, $lastname, $description, $email, $userID);
			$statement->execute();

			if($statement){
				return true;
			}else{
				return false;
			}

		}else{
			return false;
		}

}

function updateProfileImageURL($mysqli, $imageURL, $userID){



	$query = "UPDATE users SET ProfilePicURL = ? WHERE ID = ?";
		if($statement = $mysqli->prepare($query)){
			$statement->bind_param("si", $imageURL, $userID);
			$statement->execute();

			if($statement){
				return true;
			}else{
				return false;
			}

		}else{
			return false;
		}

}


function submitPost($mysqli, $title, $text, $posterID){
	$query = "INSERT INTO posts (Title, Text, PosterID) VALUES (?, ?, ?)";
	if($statement = $mysqli->prepare($query)){
		$statement->bind_param("ssi", $title, $text, $posterID);
		$statement->execute();

		if($statement){
			header( "Location: ../Pages/homePage.php" );
		}else{
			print("Error. Please contact Administrator <br>\r\n <br>\r\n");
		}
	}else{
		print("Error. Please contact Administrator <br>\r\n <br>\r\n");
	}
}

function retrievePosts($mysqli){
	$query = "SELECT posts.ID, Title, Text, PosterID, Timestamp, users.FirstName, users.LastName, users.ProfilePicURL, (SELECT COUNT(*) FROM comments WHERE comments.PostID = posts.ID) as numComments FROM posts LEFT JOIN users on users.ID = posts.PosterID ORDER BY posts.ID DESC";


    $statement = $mysqli->prepare($query);
    $statement->execute();
    $result = $statement->get_result();

    $posts = array();
    $i = 0;
      while($row = $result->fetch_array(MYSQLI_NUM)){
        $p = new Post();
          $p->ID = $row[0];
          $p->title = $row[1];
          $p->text = $row[2];
          $p->timestamp = $row[4];

          $pu = new PostUser();
          $pu->posterID = $row[3];
          $pu->firstName = $row[5];
          $pu->lastName = $row[6];
          $pu->profilePicURL = $row[7];

          $p->posterProfile = $pu;
          $p->numComments = $row[8];

        $posts[$i] = $p;
        $i++;
      }
     
    if(sizeof($posts) > 0){
    	return $posts;
    }else{
    	return false;
    }
}

function getUserProfile($mysqli, $userID){

	$query = "SELECT ID, Username, FirstName, LastName, Email, Description, ProfilePicURL FROM Users WHERE ID = ?";

	$statement = $mysqli->prepare($query);
	$statement->bind_param("i", $userID);
	$statement->execute();

	$result = $statement->get_result();
	$row = $result->fetch_array(MYSQLI_NUM);

	$row_count = mysqli_num_rows($result);

	if($row_count > 0){
		$p = new UserProfile();
		$p->ID = $row[0];
		$p->username = $row[1];
		$p->firstName = $row[2];
		$p->lastName = $row[3];
		$p->email = $row[4];
		$p->description = $row[5];
		$p->profilePicURL = $row[6];

		return $p;

	}else{
		return false;
	}


}












?>