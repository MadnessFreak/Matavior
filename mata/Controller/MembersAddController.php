<?php
class MembersAddController extends AbstractController {
	/**
	 * name of error field
	 * @var	string
	 */
	public $errorField = '';
	
	/**
	 * error type
	 * @var	string
	 */
	public $errorType = '';

	/**
	 * error message
	 * @var	string
	 */
	public $errorMessage = '';

	/**
	 * userID
	 * @var	string
	 */
	public $userID = null;

	/**
	 * username
	 * @var	string
	 */
	public $username = '';
	
	/**
	 * email address
	 * @var	string
	 */
	public $email = '';
	
	/**
	 * confirmed email address
	 * @var	string
	 */
	public $confirmEmail = '';
	
	/**
	 * user password
	 * @var	string
	 */
	public $password = '';
	
	/**
	 * confirmed user password
	 * @var	string
	 */
	public $confirmPassword = '';
	
	/**
	 * user group ids
	 * @var	array<integer>
	 */
	public $groups = array();

	/**
	 * Initializes the controller.
	 */
	public function init() {
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			$this->assign();
			parent::init();
		} else {
			$this->readParameters();

			try {
				$this->validate();
				$this->save();
				$this->assign();

				parent::init();
			}
			catch (UserInputException $e) {
				$this->errorField = $e->getField();
				$this->errorType = $e->getType();
			}
		}
	}

	/**
	 * Reads the given parameters.
	 */
	public function readParameters() {
		if (isset($_POST['username'])) $this->username = trim($_POST['username']);
		if (isset($_POST['email'])) $this->email = trim($_POST['email']);
		if (isset($_POST['confirmEmail'])) $this->confirmEmail = trim($_POST['confirmEmail']);
		if (isset($_POST['password'])) $this->password = $_POST['password'];
		if (isset($_POST['confirmPassword'])) $this->confirmPassword = $_POST['confirmPassword'];
		if (isset($_POST['groups']) && is_array($_POST['groups'])) $this->groups = $_POST['groups'];
	}

	/**
	 * Validates form inputs.
	 */
	public function validate() {
		// validate static user options
		try {
			//$this->validateUsername($this->username);
			//throw new UserInputException("username");
			
		}
		catch (UserInputException $e) {
			$this->errorType[$e->getField()] = $e->getType();
			$this->errorMessage = $e->getMessage();
		}
		
		try {
			//$this->validateEmail($this->email, $this->confirmEmail);
			//throw new UserInputException("email");
		}
		catch (UserInputException $e) {
			$this->errorType[$e->getField()] = $e->getType();
		}
		
		try {
			//$this->validatePassword($this->password, $this->confirmPassword);
			//throw new UserInputException("password");
		}
		catch (UserInputException $e) {
			$this->errorType[$e->getField()] = $e->getType();
		}
		
		// validate user groups
		/*if (!empty($this->groupIDs)) {
			$conditions = new PreparedStatementConditionBuilder();
			$conditions->add("groupID IN (?)", array($this->groupIDs));
			$conditions->add("groupType NOT IN (?)", array(array(UserGroup::GUESTS, UserGroup::EVERYONE, UserGroup::USERS)));
			
			$sql = "SELECT	groupID
					FROM	mata_groups
					".$conditions;
			$statement = WCF::getDB()->prepareStatement($sql);
			$statement->execute($conditions->getParameters());
			$this->groupIDs = array();
			while ($row = $statement->fetchArray()) {
				if (UserGroup::isAccessibleGroup(array($row['groupID']))) {
					$this->groupIDs[] = $row['groupID'];
				}
			}
		}*/
	}

	/**
	 * Saves all variables to the db.
	 */
	public function save() {
		$sql = "INSERT IGNORE INTO	mata_users
							(username, email, password, token, registrationDate, registrationIpAddress)
				VALUES		(?, ?, ?, ?, ?, ?)";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute(array(
			$this->username,
			$this->email,
			md5($this->password),
			md5('mata'),
			TIME_NOW,
			$_SERVER['REMOTE_ADDR']
		));
		
		$this->userID = Mata::getDB()->getInsertID('mata_users', 'userID');

		$sql = "INSERT IGNORE INTO	mata_user_to_group
									(userID, groupID)
				VALUES ";

		$array = array();

		foreach ($this->groups as $group) {
			array_push($array, $this->userID);
			array_push($array, $group);
			$sql .= "(?, ?), ";
		}

		$sql = substr($sql, 0, strlen($sql) - 2);
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute($array);

		header("Refresh: 3; /members/profile/" . $this->username);
	}

	/**
	 * Assigns variables to the template engine.
	 */
	public function assign() {
		Mata::getTPL()->assign('groups', UserGroup::getGroups());
		Mata::getTPL()->assign('errors', $this->errorType);
		Mata::getTPL()->assign('errorMessage', $this->errorMessage);
	}
}